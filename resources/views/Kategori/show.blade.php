@extends('layouts.MasterView')
@section('menu_kategori', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Kategori Barang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-info-circle fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>

<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
	<form>
		<div class="form-group row">
			<label for="kode_kategori" class="col-sm-12 col-md-2 col-form-label text-white">Kode Kategori</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode_kategori" id="kode_kategori"
                value="{{ $kategori->kode_kategori }}" aria-describedby="kode_kategori" placeholder="Disabled input" disabled="">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama_kategori" class="col-sm-12 col-md-2 col-form-label text-white">Nama Kategori</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_kategori" id="nama_kategori"
                value="{{ $kategori->nama_kategori }}" aria-describedby="nama_kategori" placeholder="Disabled input" disabled="">
			</div>
		</div>
		<div class="form-group row">
			<label for="keterangan" class="col-sm-12 col-md-2 col-form-label text-white">Keterangan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="keterangan" id="keterangan"
                value="{{ $kategori->keterangan }}" aria-describedby="keterangan" placeholder="Disabled input" disabled="">
			</div>
		</div>
        <div class="pull-right">
            <a href="{{route('kategori.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
        <br><br>
    </form>

</div>
@endsection
