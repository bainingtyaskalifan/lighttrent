@extends('pesanan.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Tambah Barang</h5>

		<form method="post" action="{{ route('pesanan.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_pesanan" class="form-label">ID Pesanan</label>
                <input type="text" class="form-control" id="id_pesanan" name="id_pesanan">
            </div>
			<div class="mb-3">
                <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                <input type="text" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
            </div>
            <div class="mb-3">
                <label for="tarif_pinjam" class="form-label">Tarif Pinjam</label>
                <input type="text" class="form-control" id="tarif_pinjam" name="tarif_pinjam">
            </div>
            <div class="mb-3">
                <label for="id_customer" class="form-label">ID Customer</label>
                <input type="text" class="form-control" id="id_customer" name="id_customer">
            </div>
            <div class="mb-3">
                <label for="id_lightstick" class="form-label">ID Lightstick</label>
                <input type="id_lightstick" class="form-control" id="id_lightstick" name="id_lightstick">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop