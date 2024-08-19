<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BookingsExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        // Ambil data booking berdasarkan tahun
        return Booking::with(['aula', 'user', 'transaction'])
        ->get()
        ->map(function ($booking) {
            return [
                'Aula' => $booking->aula->nama,
                'User' => $booking->user->name,
                'Keperluan' => $booking->keperluan,
                'Mulai' => Carbon::parse($booking->start)->format('d M Y'),
                'Berakhir' => Carbon::parse($booking->end)->format('d M Y'),
                'Harga' => 'Rp' . number_format(optional($booking->transaction)->price, 0, ',', '.'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Aula',
            'Nama Pemakai',
            'Keperluan',
            'Mulai',
            'Berakhir',
            'Harga',
        ];
    }

    // Styling kolom
public function styles(Worksheet $sheet)
{
    // Set default alignment dan bold untuk heading dengan ukuran font yang lebih besar
    $sheet->getStyle('A1:F1')->applyFromArray([
        'font' => [
            'bold' => true,
            'size' => 14, // Ukuran font lebih besar untuk heading
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FFFF00'],
        ],
    ]);

    // Menambah tinggi baris untuk heading
    $sheet->getRowDimension(1)->setRowHeight(30); // Tinggi baris untuk heading
}

// Events untuk memberikan styling tambahan setelah sheet di-generate
public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $cellRange = 'A1:F' . $event->sheet->getHighestRow();

            // Styling untuk semua data
            $event->sheet->getStyle($cellRange)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_LEFT, // Agar mudah dibaca
                ],
                'font' => [
                    'size' => 12, // Ukuran font lebih besar untuk seluruh data
                ],
            ]);

            // Menambah tinggi baris untuk setiap data agar lebih terlihat
            for ($i = 2; $i <= $event->sheet->getHighestRow(); $i++) {
                $event->sheet->getRowDimension($i)->setRowHeight(25); // Tinggi baris data lebih besar
            }

            // Auto-width untuk semua kolom
            foreach (range('A', 'F') as $col) {
                $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
            }
        },
    ];
}

}
