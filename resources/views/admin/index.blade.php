@extends('admin.layout')

@section('content')

<h4 class="mt-5">Data Customer</h4>

<div class="row g-3 align-items-center mt-2">
  <div class="col-auto">
    <form action="/customer" method="GET">
        <input type="search" id="search" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Cari">
    </form>
  </div>
</div>

<a href="{{ route('admin.create') }}" type="button" class="btn btn-secondary rounded-3 mt-4">Tambah Data</a>

<a href="{{ route('pesanan.index') }}" type="button" class="btn btn-danger rounded-3 mt-4">Previous</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Customer</th>
        <th>Alamat Customer</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_customer }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->alamat }}</td>
                <td>
                    <a href="{{ route('admin.edit', $data->id_customer) }}" type="button" class="btn btn-secondary rounded-3">Ubah</a>

                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#hapussetengah{{ $data->id_customer }}">
                        Hapus
                    </button>

                    <div class="modal fade" id="hapussetengah{{ $data->id_customer }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.softDelete', $data->id_customer) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah benar anda ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_customer }}">
                        Hilang
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_customer }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.delete', $data->id_customer) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        {{-- <tr>
            <td>1</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>test</td>
            <td>
                <a href="#" type="button" class="btn btn-warning rounded-3">Ubah</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr> --}}
    </tbody>
</table>
@stop