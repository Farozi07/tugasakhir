<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Aula;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;


class PictureController extends Controller{
    public function index()
    {
        $aula = Aula::all();
        $pictures = Picture::all();
        // return $pictures;
        return view('admin.picture', compact('pictures','aula'));
    }

    public function store(Request $request)
    {
    // return $request;
    $validatedData = $request->validate([
        'aula' => 'required|in:1,2,3',
        'image' => 'required|image',
    ]);

    // Path untuk lokasi gambar
    $path = 'picture/' . md5(date('dmyhis')) . '.jpg';

    // Proses upload gambar
    $manager = new ImageManager(Driver::class);
    $image = $manager->read($request->file('image'));
    $encoded = $image->toJpeg(100)->save($path);

    // Simpan data gambar ke tabel picture
    Picture::create([
        'aula_id' => $request->aula,
        'image_path' => $path,
    ]);

    return redirect()->back()->with('success', 'Picture created successfully.');
    }

    public function update(Request $request, Picture $picture)
    {
        if ($request->hasFile('image')) {
            // Path untuk lokasi gambar
            $path = 'picture/' . md5(date('dmyhis')) . '.jpg';

            // Proses upload gambar
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->file('image'));
            $encoded = $image->toJpeg(100)->save($path);
            // Hapus gambar lama jika ada
            if (file_exists(public_path($picture->image_path))) {
                unlink(public_path($picture->image_path));
            }

            // Update data gambar
            $picture->update([
                'image_path' => $path,
            ]);
        }
        // Update nama aula
        $picture->update([
            'aula_id' => $request->aula,
        ]);
        return redirect()->back()->with('success', 'Gambar berhasil diupdate.');
    }

    public function destroy($id){
    $gambar = Picture::find($id);
    if (file_exists($gambar->image_path)) {
        unlink($gambar->image_path);
    }
    $gambar->forceDelete();
    return redirect()->back()->with('success','Berhasil Menghapus Gambar');
    }
}
