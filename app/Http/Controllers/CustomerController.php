<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
 public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('SELECT * FROM customer WHERE is_delete = 0 and customer.nama = :search;',[
            'search'=>$request->search   
        ]);
    return view('admin.index')
        ->with('datas', $datas);
        } 
             else {
               $datas = DB::select('SELECT * FROM customer WHERE is_delete = 0');
            return view('admin.index')
                ->with('datas', $datas);
            }
        }

    public function create() {
        return view('admin.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_customer' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO customer(id_customer, nama, alamat) VALUES (:id_customer, :nama, :alamat)',
        [
            'id_customer' => $request->id_customer,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('admin.index')->with('success', 'Data Customer berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('customer')->where('id_customer', $id)->first();

        return view('admin.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_customer' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE customer SET nama = :nama, alamat = :alamat  WHERE id_customer = :id_customer',
        [
            'id_customer' => $id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('admin.index')->with('success', 'Data Customer berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM customer WHERE id_customer = :id_customer', ['id_customer' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('admin.index')->with('success', 'Data Customer berhasil dihapus');
    }

    public function softDelete ($id) {
        DB::update('UPDATE customer SET is_delete = 1 WHERE id_customer = :id_customer', ['id_customer' => $id]);
        return redirect()->route('admin.index')->with('success', 'Data Pesanan berhasil dihapus');
    }
}