@extends('bagian.main')

@section('content')
    <x-dynamic-content>
        <!-- CSS DataTables -->


 
            <h1 class="h3 mb-0 text-gray-800">Halaman Data Transaksi</h1>
            <p class="mb-4">
                Tabel data Transaksi yang tersimpan
            </p>
        
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary col-6">Data Riwayat Transaksi</h6>
                        <span class="col-6 text-right">
                            <a href="{{route('kasir')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                ><i class="fas fa-plus fa-sm text-white-50"></i>
                                Tambah Data</a>
                        </span>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nomor Nota</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Total Belanja</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($penjualans as $key => $penjualan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $penjualan->TanggalPenjualan }}</td>
                                    <td>{{ $penjualan->NoNota }}</td>
                                    <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Diketahui'}}</td>
                                    <td>{{ formatrupiah($penjualan->TotalHarga) }}</td>
                                    <td>{{ formatrupiah($penjualan->TotalBayar) }}</td>
                                    <td>{{ formatrupiah($penjualan->Kembalian) }}</td>
                                    <td>
                                        <a href="#" id="tomboledit" class="btn btn-sm btn-primary edit-btn"
                                            data-toggle="modal" data-target="#edit" 
                                            data-id="{{ $penjualan->NoNota }}"
                                            
                                            >


                                            Detail
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#hapus{{ $penjualan->id }}">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

       
       


        

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        

    </x-dynamic-content>
@endsection
