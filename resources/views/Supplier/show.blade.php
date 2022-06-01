@extends('layouts.MasterView')
@section('menu_supplier', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Supplier</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
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
                            <label for="kode" class="col-sm-10 col-md-4 col-form-label text-white">Kode Supplier</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="kode" id="kode"
                                value="{{ $supplier->kode }}" aria-describedby="kode" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="nama" class="col-sm-10 col-md-4 col-form-label text-white">Nama Supplier</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="nama" id="nama"
                                value="{{ $supplier->nama }}" aria-describedby="nama" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="alamat" class="col-sm-10 col-md-4 col-form-label text-white">Alamat</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="alamat" id="alamat"
                                value="{{ $supplier->alamat }}" aria-describedby="alamat" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="telp" class="col-sm-10 col-md-4 col-form-label text-white">Telepon</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="telp" id="telp"
                                value="{{ $supplier->telp }}" aria-describedby="telp" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="kota" class="col-sm-10 col-md-4 col-form-label text-white">Kota</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="kota" id="kota"
                                value="{{ $supplier->kota }}" aria-describedby="kota" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="penyedia" class="col-sm-10 col-md-4 col-form-label text-white">Penyedia Barang</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="penyedia" id="penyedia"
                                value="{{ $supplier->penyedia }}" aria-describedby="penyedia" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="{{route('supplier.index')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
