@extends('layouts.MasterView')
@section('menu_BarangMasuk', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Barang Masuk</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('BarangMasuk.index') }}">Barang Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-info-circle fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class="product-wrap">
    <div class="product-detail-wrap mb-30">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="kode_masuk" class="col-sm-10 col-md-4 col-form-label text-white">Kode In</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="text" name="kode_masuk" id="kode_masuk"
                                value="{{ $masuk->kode_masuk }}" aria-describedby="kode_masuk" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_keluar" class="col-sm-10 col-md-4 col-form-label text-white">Kode Out</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="text" name="id_keluar" id="id_keluar"
                                value="{{ $masuk->BarangKeluar->kode }}" aria-describedby="id_keluar" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_barang" class="col-sm-10 col-md-4 col-form-label text-white">Nama Barang</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="text" name="id_barang" id="id_barang"
                                value="{{ $masuk->barang->nama_barang }}" aria-describedby="id_barang" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_barang" class="col-sm-10 col-md-4 col-form-label text-white">Kode Barang</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="text" name="id_barang" id="id_barang"
                                value="{{ $masuk->barang->kode_barang }}" aria-describedby="id_barang" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_keluar" class="col-sm-10 col-md-4 col-form-label text-white">Penanggung Jawab</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="text" name="id_keluar" id="id_keluar"
                                value="{{ $masuk->BarangKeluar->penanggung_jawab }}" aria-describedby="id_keluar" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="jumlah_masuk" class="col-sm-10 col-md-4 col-form-label text-white">Jumlah Masuk</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="number" name="jumlah_masuk" id="jumlah_masuk"
                                value="{{ $masuk->jumlah_masuk }}" aria-describedby="jumlah_masuk" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_keluar" class="col-sm-10 col-md-4 col-form-label text-white">Tgl Keluar</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="date" name="id_keluar" id="id_keluar"
                                value="{{ $masuk->BarangKeluar->tgl_keluar }}" aria-describedby="id_keluar" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="tgl_masuk" class="col-sm-10 col-md-4 col-form-label text-white">Tgl Masuk</label>
			                <div class="col-md-7 col-sm-12">
				                <input class="form-control" type="date" name="tgl_masuk" id="tgl_masuk"
                                value="{{ $masuk->tgl_masuk }}" aria-describedby="tgl_masuk" placeholder="Disabled input" disabled="">
			                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="{{route('BarangMasuk.index')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
