<?php

namespace App\Http\Controllers;

use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $datas = DB::select('SELECT
            pesanan.id_pesanan,
            pesanan.tgl_pinjam,
            pesanan.tarif_pinjam,
            customer.nama,
            lightstick.nama_lightstick
          FROM pesanan
          LEFT JOIN customer
            ON pesanan.id_customer = customer.id_customer
          LEFT JOIN lightstick
            ON lightstick.id_lightstick = pesanan.id_lightstick
            WHERE pesanan.is_delete = 0 AND customer.nama = :search;',[
                'search'=>$request->search ]);
                // LIKE \'%' . $request->search . '%\';');
            return view('pesanan.index')
            ->with('datas', $datas);
        }
        else{
            $datas = DB::select('SELECT
            pesanan.id_pesanan,
            pesanan.tgl_pinjam,
            pesanan.tarif_pinjam,
            customer.nama,
            lightstick.nama_lightstick
          FROM pesanan
          LEFT JOIN customer
            ON pesanan.id_customer = customer.id_customer
          LEFT JOIN lightstick
            ON lightstick.id_lightstick = pesanan.id_lightstick WHERE pesanan.is_delete = 0');
            return view('pesanan.index')
            ->with('datas', $datas);
        }

    }

    public function create() {
        // $customer = DB::select('SELECT * FROM customer WHERE is_delete = 0');
        // return view('pesanan.add', ["customer"=>$customer]);
        return view('pesanan.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pesanan' => 'required',
            'tgl_pinjam' => 'required',
            'tarif_pinjam' => 'required',
            'id_customer' => 'required',
            'id_lightstick' => 'required'
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pesanan(id_pesanan, tgl_pinjam, tarif_pinjam, id_customer, id_lightstick) VALUES (:id_pesanan, :tgl_pinjam, :tarif_pinjam, :id_customer, :id_lightstick)',
        [
            'id_pesanan' => $request->id_pesanan,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tarif_pinjam' => $request->tarif_pinjam,
            'id_customer' => $request->id_customer,
            'id_lightstick' => $request->id_lightstick
        ]
        );

        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pesanan')->where('id_pesanan', $id)->first();

        return view('pesanan.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pesanan' => 'required',
            'tgl_pinjam' => 'required',
            'tarif_pinjam' => 'required',
            'id_customer' => 'required',
            'id_lightstick' => 'required'
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pesanan SET tgl_pinjam = :tgl_pinjam, tarif_pinjam = :tarif_pinjam, id_customer = :id_customer, id_lightstick = :id_lightstick WHERE id_pesanan = :id_pesanan',
        [
            'id_pesanan' => $id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tarif_pinjam' => $request->tarif_pinjam,
            'id_customer' => $request->id_customer,
            'id_lightstick' => $request->id_lightstick
        ]
        );

        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pesanan WHERE id_pesanan = :id_pesanan', ['id_pesanan' => $id]);
        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil dihapus');
    }

    public function softDelete ($id) {
        DB::update('UPDATE pesanan SET is_delete = 1 WHERE id_pesanan = :id_pesanan', ['id_pesanan' => $id]);
        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil dihapus');
    }
}
