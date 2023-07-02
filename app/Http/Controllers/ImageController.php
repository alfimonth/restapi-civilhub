<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan gambar ke direktori yang diinginkan
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->storeAs('public', $imageName);

        // Kirim response ke Flutter
        return response()->json([
            'message' => 'Gambar berhasil diunggah',
            'image_path' => url('storage/' . $imageName)
        ], 200);
    }
}
