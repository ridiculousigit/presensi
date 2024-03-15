<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use File;
use App\Model\Asisten;

class AsistenController extends Controller
{
    // Menampilkan daftar asisten
    public function index()
    {
        $data['asisten'] = Asisten::orderBy('created_at', 'DESC')->get();
        // Mengembalikan view dengan data asisten
        return view('backend.data.asisten.index', $data);
    }

    // Menyimpan data asisten baru
    public function store(Request $request)
    {
        // Mengenkripsi kata sandi
        $hashed = Hash::make($request->password1);
        $password2 = $request->password2;
        if(Hash::check($request->password2, $hashed)){
            $store = new Asisten;
            $store->id_asisten = $request->id_asisten;
            $store->name = $request->name;
            $store->join_date = $request->join_date;
            $store->role = $request->role;
            $store->email = $request->email;
            $store->password = $hashed;
            
            // Menyimpan foto ke direktori
            $photo = $request->photo;
            $namafile = $photo->getClientOriginalName();
            $photo->move('photo', $namafile);
            $store->photo = $namafile;
            $store->save();
            if(!$store){
                $Response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
            } else {
                $Response = ['success' => "Data Asisten berhasil disimpan"]; 
            }

        } else {
            $Response = ['error' => "Kata sandi tidak sama"];
        }
        return response()->json($Response, 200);
    }

    // Mengambil data asisten untuk diedit
    public function edit(Request $request)
    {
        $edit = Asisten::findOrFail($request->id);
        return response()->json($edit);
    }

    // Memperbarui data asisten
    public function update(Request $request)
    {   
        if($request->password1) {
            // Mengecek kesamaan kata sandi
            $hashed = Hash::make($request->password1);
            $password2 = $request->password2;
            if(Hash::check($request->password2, $hashed)){
                $update = Asisten::findOrFail($request->id);
                $update->id_asisten = $request->id_asisten;
                $update->name = $request->name;
                $update->join_date = $request->join_date;
                // Memperbarui peran asisten
                if($update->role == "Asisten" || $update->role == "PJ") {
                    $update->role = $request->role2;
                } else {
                    $update->role = $request->role;
                }
                
                $update->email = $request->email;
                $update->password = $hashed;
                
                // Memperbarui foto asisten
                if($request->hasFile('photo')) {
                    $path = 'photo/'.$update->photo;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    $photo = $request->photo;
                    $namafile = $photo->getClientOriginalName();
                    $photo->move('photo', $namafile);
                    $update->photo = $namafile;
                }
                $update->save();
                if(!$update){
                    $Response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
                } else {
                    $Response = ['success' => "Data Asisten berhasil diperbarui"]; 
                }

            } else {
                $Response = ['error' => "Kata sandi tidak sama"];
            }
        } else {
            $update = Asisten::findOrFail($request->id);
            $update->id_asisten = $request->id_asisten;
            $update->name = $request->name;
            $update->join_date = $request->join_date;
            if($update->role == "Asisten" || $update->role == "PJ") {
                $update->role = $request->role2;
            } else {
                $update->role = $request->role;
            }
            $update->email = $request->email;

            // Memperbarui foto asisten
            if($request->hasFile('photo')) {
                $path = 'photo/'.$update->photo;
                if(File::exists($path)){
                    File::delete($path);
                }
                $photo = $request->photo;
                $namafile = $photo->getClientOriginalName();
                $photo->move('photo', $namafile);
                $update->photo = $namafile;
            }
            $update->save();
            if(!$update){
                $Response = ['error' => "Terjadi kesalahan dalam menyimpan data"];
            } else {
                $Response = ['success' => "Data Asisten berhasil diperbarui"]; 
            }
        } 
        return response()->json($Response, 200);
    }

    // Menghapus data asisten
    public function destroy($id)
    {
        $destroy = Asisten::findOrFail($id);
        $path = 'photo/'.$destroy->photo;
        if(File::exists($path)){
            File::delete($path);
        }
        $destroy->delete();

        return redirect()->back();
    }

    // Mengedit profil asisten
    public function editProfile($id)
    {
        $data['profile'] = Asisten::findOrFail($id);

        return view('backend.profile', $data);
    }
}