<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class FormController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        // dd($request->all());
        $mahasiswa = New Mahasiswa;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->save();

        return response()->json([
            'message' => 'Data Berhasil Di Tambahkan',
            'data_mahasiswa' => $mahasiswa,
        ], 200);
    }

    public function edit($id){
        $mahasiswa = Mahasiswa::find($id);
        
        return response()->json([
            'message' => 'Succsess',
            'data_mahasiswa' => $mahasiswa,
        ], 200);
    }

    public function update(Request $request, $id){
        $mahasiswa = Mahasiswa::find($id);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json([
            'message' => 'Succsess',
            'data_mahasiswa' => $mahasiswa,
        ], 200);
    }

    public function delete($id){
        $mahasiswa = Mahasiswa::find($id)->delete();
        
        return response()->json([
            'message' => 'Data Dihapus',
            'data_mahasiswa' => $mahasiswa,
        ], 200);
    }

}
