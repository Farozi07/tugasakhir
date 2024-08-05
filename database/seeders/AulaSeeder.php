<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aula;


class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aula::create(
            [
                'nama' => 'Aula Bhinneka Tunggal Ika',
                'price' => '3000000',
                'deskripsi' => '100 Orang',
                'category' => 'danger',
            ]
        );

        Aula::create(
            [
                'nama' => 'Aula Garuda',
                'price' => '2000000',
                'deskripsi' => '100 S.D 150 Orang',
                'category' => 'warning',
            ]
        );

        Aula::create(
            [
                'nama' => 'Aula Akcaya',
                'price' => '1000000',
                'deskripsi' => '40 Orang',
                'category' => 'success',
            ]
        );
    }
}
