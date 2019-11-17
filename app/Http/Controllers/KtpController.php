<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use Illuminate\Validation\Rule;


class KtpController extends Controller
{
    public function index()
    {
        $ktp = \App\Ktp::all();
        return view('ktp.index',['ktp'=>$ktp]);
    }

    public function create()
    {
        return view('ktp.create');
    }

    public function store(Request $request)
    {   
        \Validator::make( $request->all(),
        ['nik' => 'unique:ktp',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal' => 'before:-17 years',]
        ,['unique' => 'No NIK Tidak Boleh Sama',
        'image' => 'Format Gambar Salah',
        'before' => 'Umur Harus Lebih Dari 17 Tahun',])->validate();

        $ktp = new \App\Ktp;
        $ktp->nik =  $request->get('nik');
        $ktp->nama =  $request->get('nama');
        $ktp->tmpt_lhr =  $request->get('tempat');
        $ktp->tgl_lhir =  $request->get('tanggal');
        $ktp->jenkel =  $request->get('jenkel');
        $ktp->goldarah =  $request->get('goldarah');
        $ktp->alamat =  $request->get('alamat');
        $ktp->rt =  $request->get('rt');
        $ktp->rw =  $request->get('rw');
        $ktp->kel =  $request->get('kel');
        $ktp->kec =  $request->get('kec');
        $ktp->agama =  $request->get('agama');
        $ktp->status =  $request->get('kawin');
        $ktp->pekerjaan =  $request->get('pekerjaan');
        $ktp->kewarga =  $request->get('kewarga');
        $ktp->berlaku = date('Y-m-d', strtotime('+5 years'));

        if($request->file('image'))
        {
            $gambar = $request->file('image')->store('foto', 'public');
            
            $ktp->foto = $gambar;
        }

        $ktp->save();
    
        return redirect()->route('ktp.index')->with('status', 'Ktp Berhasil Di Buat');
    }

    public function show($id)
    {
        $ktp = \App\Ktp::findOrFail($id);
        return view('ktp.detail', ['ktp' => $ktp]);
    }

    public function edit($id)
    {
        $ktp = \App\Ktp::findOrFail($id);
        return view('ktp.edit', ['ktp' => $ktp]);
    }

    public function update(Request $request, $id)
    {   
        \Validator::make($request->all(),
        ['nik' => [Rule::unique('ktp')->ignore($id,'nik')],
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal' => 'before:-17 years',]
        ,['unique' => 'No NIK Tidak Boleh Sama',
        'image' => 'Format Gambar Salah',
        'before' => 'Umur Harus Lebih Dari 17 Tahun',])->validate();

        $ktp = \App\Ktp::findOrFail($id);

        if($request->get('hapus_gambar') == 1)
        {
            if($ktp->foto && file_exists(storage_path('app/public/' . $ktp->foto)))
            {
                \Storage::delete('public/' . $ktp->foto);
                $ktp->foto = NULL;
            }
        }
        
        $ktp->nik =  $request->get('nik');
        $ktp->nama =  $request->get('nama');
        $ktp->tmpt_lhr =  $request->get('tempat');
        $ktp->tgl_lhir =  $request->get('tanggal');
        $ktp->jenkel =  $request->get('jenkel');
        $ktp->goldarah =  $request->get('goldarah');
        $ktp->alamat =  $request->get('alamat');
        $ktp->rt =  $request->get('rt');
        $ktp->rw =  $request->get('rw');
        $ktp->kel =  $request->get('kel');
        $ktp->kec =  $request->get('kec');
        $ktp->agama =  $request->get('agama');
        $ktp->status =  $request->get('kawin');
        $ktp->pekerjaan =  $request->get('pekerjaan');
        $ktp->kewarga =  $request->get('kewarga');

        if($request->file('image'))
        {   
            if($ktp->foto && file_exists(storage_path('app/public/' . $ktp->foto)))
            {
                \Storage::delete('public/' . $ktp->foto);
            }
            $gambar = $request->file('image')->store('foto', 'public');
            $ktp->foto = $gambar;
        }

        $ktp->save();
    
        return redirect()->route('ktp.index')->with('status', 'Ktp Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $ktp = \App\Ktp::findOrFail($id);
        
        if($ktp->foto && file_exists(storage_path('app/public/' . $ktp->foto)))
        {
            \Storage::delete('public/' . $ktp->foto);
        }
        $ktp->delete();
        return redirect()->route('ktp.index')->with('status', 'Ktp Berhasil Di Hapus');
        
    }
}
