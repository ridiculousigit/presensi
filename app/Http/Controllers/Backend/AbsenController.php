<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Model\Absen;
use App\Model\Kelas;
use App\Model\Materi;
use App\Model\Asisten;
use App\Model\Kode;

class AbsenController extends Controller
{
    public function store(Request $request)
    {
        $idLogin = Auth::id();
        $getIdAsisten = $request->id_asisten;
        $getKode = $request->kode;
        $getIdMateri = $request->materi;
        $getIdKelas = $request->kelas;
        $getPeran = $request->peran_jaga;

        // Periksa id asisten
        $getMatchId = User::where('id_asisten', $getIdAsisten)->first();
        if ($idLogin == $getMatchId->id) {
            // Periksa kode
            $getMatchKode = Kode::where('code', $getKode)->first();
            if ($getKode == $getMatchKode->code && (empty($getMatchKode->id_user_get))) {
                // Periksa apakah kode absen tidak sama dengan yang dibuat sendiri
                if ($getMatchKode->id_user != $idLogin) {
                    $store = new Absen;
                    $store->id_kelas = $getIdKelas;
                    $store->id_materi = $getIdMateri;
                    $store->id_asisten = $idLogin;
                    $store->teaching_role = $getPeran;

                    $today = Carbon::now("GMT+7")->toDateString();
                    $timeNow = Carbon::now("GMT+7")->toTimeString();

                    $store->date = $today;
                    $store->start = $timeNow;
                    $store->id_code = $getMatchKode->id;
                    $store->save();

                    $getMatchKode->id_user_get = $idLogin;
                    $getMatchKode->save();
                    if (!$store) {
                        $Response = ['error' => "Gagal absen"];
                    } else {
                        $Response = ['success' => "Absen berhasil"];
                    }
                } else {
                    $Response = ['error' => "Gagal absen"];
                }
            } else {
                $Response = ['error' => "Gagal absen"];
            }
        } else {
            $Response = ['error' => "Gagal absen"];
        }

        return response()->json($Response, 200);
    }
    
     // Memperbarui data absen
    public function update(Request $request)
    {
        $carbon = Carbon::now('GMT+7');
        $today = $carbon->toDateString();
        $idLogin = Auth::id();
        $cekAbsen = Absen::where('id_asisten', $idLogin)->where('date', $today)->where('end', null)->first();

        $masuk = $cekAbsen->start;
        $keluar = Carbon::now("GMT+7")->toTimeString();
        $cekAbsen->end = $keluar;
        $hasil = $carbon->diffInMinutes($masuk);
        $cekAbsen->duration = $hasil;
        $cekAbsen->save();

        if (!$cekAbsen) {
            $Response = ['error' => "Gagal saat menyimpan clockout"];
        } else {
            $Response = ['success' => "Berhasil melakukan clockout"];
        }
        return response()->json($Response, 200);
    }
}
