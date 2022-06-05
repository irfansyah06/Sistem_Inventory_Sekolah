@extends('layouts.MasterView')
@section('menu_user', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
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
	<form method="POST" action="{{ route('user.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
		</div>
		<div class="form-group row">
			<label for="name" class="col-sm-12 col-md-2 col-form-label text-white">Nama</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="name" id="name" aria-describedby="name" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="username" class="col-sm-12 col-md-2 col-form-label text-white">Username</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="username" id="username" aria-describedby="username" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-12 col-md-2 col-form-label text-white">Email</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="email" name="email" id="email" aria-describedby="email" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="password" class="col-sm-12 col-md-2 col-form-label text-white">Password</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="password" name="password" id="password" aria-describedby="password" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Role</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select col-12" type="role" name="role" id="role">
                    <option value="">Choose Role</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Operator">Operator</option>
                </select>
            </div>
		</div>
        <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label text-white">Gambar</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="file" name="gambar" id="gambar" aria-describedby="gambar" placeholder=""></br>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('user.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
