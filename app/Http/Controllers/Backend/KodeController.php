<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\Kode;
use Auth;
use App\User;

class KodeController extends Controller
{
    // Menampilkan daftar kode yang di-generate oleh user yang sedang login
    public function index()
    {
        $data['kode'] = Kode::orderBy('created_at', 'DESC')
            ->join('users', 'code.id_user', 'users.id')
            ->where('id_user', Auth::id())
            ->select('users.name', 'code.*')
            ->get();
        return view('backend.generator.index', $data);
    }

    // Menyimpan data kode baru
    public function store(Request $request)
    {
        // Generate kode acak sepanjang 8 karakter
        $kode = Str::random(8);
        $store = new Kode;
        $store->id_user = Auth::id();
        $store->code = $kode;
        $store->save();
        if (!$store) {
            $Response = ['error' => "Gagal menyimpan data"];
        } else {
            $Response = ['success' => "Berhasil", 'kode' => $kode];
        }
        return response()->json($Response, 200);
    }
}
