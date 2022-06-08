@extends('layouts.MasterView')
@section('menu_BarangMasuk', 'active')
@section('content')
<div >
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Barang Masuk</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('BarangMasuk.index') }}">Barang Masuk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="{{ url('/laporan/BarangMasuk') }}">
                    Download Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- multiple select row Datatable start -->
    <div class="page-header mb-30">
        <div class="pb-20">
            <div class="header-left">
                <div class="header-search col-sm-12">
                    <form class="form" method="GET" action="{{ route('BarangMasuk.index') }}">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control search-input" name="search" placeholder="Search Here">
                            <div class="dropdown">
                                <a class="dropdown-toggle no-arrow" type="submit">
                                    <i class="dw dw-search2 search-icon"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-40 col-sm-12 text-right">
                    <a class="btn btn-success" href="{{ route('BarangMasuk.create') }}"> Create Data </a>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="data-table table hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">No</th>
                        <th>Kode In</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tgl Masuk</th>
                        <th>Status</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masuk as $in => $data)
                    <tr>
                        <td class="table-plus">{{ $in + $masuk->firstitem() }}</td>
                        <td>{{ $data->kode_masuk}}</td>
                        <td>{{ $data->barang->nama_barang }}</td>
                        <td>{{ $data->jumlah_masuk }}</td>
                        <td>{{ $data->tgl_masuk}}</td>
                        <td>
                            @if ($data->BarangKeluar->jumlah == 0)
                            <label class="badge badge-success">Kembali Seluruhnya</label>
                            @elseif ($data->BarangKeluar->jumlah > 0)
                            <label class="badge badge-warning">Kembali Sebagian</label>
                            @else
                            <label class="badge badge-danger">Eror</label>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <form action="{{ route('BarangMasuk.destroy', $data->kode_masuk) }}" method="POST">
                                        <a class="dropdown-item" href="{{ route('BarangMasuk.show', $data->kode_masuk) }}"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="{{ route('BarangMasuk.edit', $data->kode_masuk) }}"><i class="dw dw-edit2"></i> Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin meghapus data ini ?')" type="submit">
                                            <i class="dw dw-delete-3"></i> Delete
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-40 col-sm-12 text-left">
                {{$masuk->links()}}
            </div>
        </div>
    </div>
</div>
<!-- multiple select row Datatable End -->
@endsection
