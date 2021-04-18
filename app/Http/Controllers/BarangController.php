<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;

class BarangController extends Controller
{
    public function list()
    {
        $hasil = DB::select('select * from barang');
        return view('list-barang', ['data' => $hasil]);
    }
    public function simpan(Request $req)
    {
        DB::insert(
            'insert into barang (nama_barang, kategori_barang, stock_barang) values (?, ?, ?)',
            [$req->nama_barang, $req->kategori_barang, $req->stock_barang]
        );
        $hasil = DB::select('select * from barang');
        return view('list-barang', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from barang where id = ?', [$req]);

        $hasil = DB::select('select * from barang');
        return view('list-barang', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from barang where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update barang set ' .
                'nama_barang=?, ' .
                'kategori_barang=?, ' .
                'stock_barang=? where id=? ',
            [
                $req->nama_barang,
                $req->kategori_barang,
                $req->stock_barang,
                $req->id
            ]
        );
        $hasil = DB::select('select * from barang');
        return view('list-barang', ['data' => $hasil]);
    }
}
