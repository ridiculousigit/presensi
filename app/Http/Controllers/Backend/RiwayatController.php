<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Absen;
use App\Model\Kelas;
use App\Model\Materi;
use App\Model\Kode;
use Auth;

class RiwayatController extends Controller
{
    // Menampilkan riwayat absen untuk user yang sedang login
    public function index()
    {
        $data['absen'] = Absen::join('users', 'absensi.id_asisten', 'users.id')
            ->join('kelas', 'absensi.id_kelas', 'kelas.id')
            ->join('materi', 'absensi.id_materi', 'materi.id')
            ->join('code', 'absensi.id_code', 'code.id')
            ->where('users.id', Auth::id())
            ->select('users.id', 'users.name', 'users.id_asisten as idasisten', 'kelas.nama_kelas', 'materi.materi', 'absensi.*')
            ->orderBy('absensi.created_at', 'DESC')
            ->get();
        return view('backend.report.riwayat', $data);
    }

    // Menampilkan laporan riwayat absen untuk semua user
    public function report()
    {
        $data['absen'] = Absen::join('users', 'absensi.id_asisten', 'users.id')
            ->join('kelas', 'absensi.id_kelas', 'kelas.id')
            ->join('materi', 'absensi.id_materi', 'materi.id')
            ->join('code', 'absensi.id_code', 'code.id')
            ->select('users.id', 'users.name', 'users.id_asisten as idasisten', 'kelas.nama_kelas', 'materi.materi', 'absensi.*')
            ->orderBy('absensi.created_at', 'DESC')
            ->get();
        return view('backend.report.report', $data);
    }

    // Mencari riwayat absen berdasarkan rentang tanggal
    public function search(Request $request)
    {
        $data['absen'] = Absen::join('users', 'absensi.id_asisten', 'users.id')
            ->join('kelas', 'absensi.id_kelas', 'kelas.id')
            ->join('materi', 'absensi.id_materi', 'materi.id')
            ->join('code', 'absensi.id_code', 'code.id')
            ->where('absensi.date', '>=', $request->start)
            ->where('absensi.date', '<=', $request->end)
            ->select('users.id', 'users.name', 'users.id_asisten as idasisten', 'kelas.nama_kelas', 'materi.materi', 'absensi.*')
            ->orderBy('absensi.created_at', 'DESC')
            ->get();
        return view('backend.report.report', $data);
    }
}
