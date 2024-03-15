<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kelas;

class KelasController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $data['kelas'] = Kelas::orderBy('created_at', 'DESC')->get();
        return view('backend.data.kelas.index', $data);
    }

    // Menyimpan data kelas baru
    public function store(Request $request)
    {
        // Mengambil semua data dari request
        $data = $request->all();
        // Menyimpan data ke dalam database
        $store = Kelas::create($data);
        // Menyiapkan respon berdasarkan hasil penyimpanan
        if (!$store) {
            $Response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
        } else {
            $Response = ['success' => "Data berhasil disimpan"];
        }
        return response()->json($Response, 200);
    }

    // Mengambil data kelas untuk diedit
    public function edit(Request $request)
    {
        $edit = Kelas::findOrFail($request->id);
        return response()->json($edit);
    }

    // Memperbarui data kelas
    public function update(Request $request)
    {
        $update = Kelas::findOrFail($request->id);
        $update->jurusan = $request->jurusan;
        $update->fakultas = $request->fakultas;
        $update->tingkat = $request->tingkat;
        $update->nama_kelas = $request->nama_kelas;
        $update->save();
        // Menyiapkan respon berdasarkan hasil penyimpanan
        if (!$update) {
            $Response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
        } else {
            $Response = ['success' => "Data berhasil disimpan"];
        }
        return response()->json($Response, 200);
    }

    // Menghapus data kelas
    public function destroy($id)
    {
        $destroy = Kelas::findOrFail($id);
        $destroy->delete();

        return redirect()->back();
    }
}