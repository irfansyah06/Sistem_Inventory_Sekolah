@extends('layouts.MasterView')
@section('menu_supplier', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Supplier</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy dw dw-add-file-1 fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
	@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	<form method="POST" action="{{ route('supplier.store') }}" id="myForm">
        @csrf
		<div class="form-group row">
			<label for="kode" class="col-sm-12 col-md-2 col-form-label text-white">Kode Supplier</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode" id="kode" aria-describedby="kode" value="{{$code}}" placeholder readonly="">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama" class="col-sm-12 col-md-2 col-form-label text-white">Nama Supplier</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama" id="nama" aria-describedby="nama" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="alamat" class="col-sm-12 col-md-2 col-form-label text-white">Alamat</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="alamat" id="alamat" aria-describedby="alamat" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="telp" class="col-sm-12 col-md-2 col-form-label text-white">Telepon</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="telp" id="telp" aria-describedby="telp" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="kota" class="col-sm-12 col-md-2 col-form-label text-white">Kota</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kota" id="kota" aria-describedby="kota" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="penyedia" class="col-sm-12 col-md-2 col-form-label text-white">Penyedia Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="penyedia" id="penyedia" aria-describedby="penyedia" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('supplier.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->
@endsection
