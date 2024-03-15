<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Materi;

class MateriController extends Controller
{

    // Menampilkan daftar materi
    public function index()
    {
        $materi = Materi::orderBy('created_at', 'DESC')->get();
        return view('backend.data.materi.index', compact('materi'));
    }

    // Menyimpan data materi baru
    public function store(Request $request)
    {
        $store = Materi::create($request->all());

        if ($store) {
            $response = ['success' => "Data berhasil disimpan"];
        } else {
            $response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
        }
        return response()->json($response, 200);
    }

    // Mengambil data materi untuk proses pengeditan
    public function edit(Request $request)
    {
        $edit = Materi::findOrFail($request->id);
        return response()->json($edit);
    }

    // Memperbarui data materi
    public function update(Request $request)
    {
        $update = Materi::findOrFail($request->id);
        $update->materi = $request->materi;
        $update->save();

        if ($update) {
            $response = ['success' => "Data berhasil diperbarui"];
        } else {
            $response = ['error' => "Terjadi kesalahan dalam memperbarui data"];
        }
        return response()->json($response, 200);
    }

    // Menghapus data materi
    public function destroy($id)
    {
        $destroy = Materi::findOrFail($id);
        if ($destroy->delete()) {
            $response = ['delete' => "Data berhasil dihapus"];
        } else {
            $response = ['error' => "Terjadi kesalahan dalam menghapus data"];
        }
        return response()->json($response, 200);
    }
}