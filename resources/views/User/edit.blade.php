@extends('layouts.MasterView')
@section('menu_user', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
	<form method="POST" action="{{ route('user.update', $user->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
			<label for="password" class="col-sm-12 col-md-2 col-form-label text-white">Password</label>
			<div class="col-sm-12 col-md-10">
				<a href="{{route('user.edit.password', $user->id)}}" type="button" class="btn btn-info btn-lg btn-block">Edit Password</a>
			</div>
		</div>
		<div class="form-group row">
			<label for="name" class="col-sm-12 col-md-2 col-form-label text-white">Nama</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" aria-describedby="name" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="username" class="col-sm-12 col-md-2 col-form-label text-white">Username</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}" aria-describedby="username" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-12 col-md-2 col-form-label text-white">Email</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" aria-describedby="email" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Role</label>
			<div class="col-sm-12 col-md-10">
				<select class="custom-select col-12" type="role" name="role" id="role">
                    <option value="Administrator" @if($user->role == 'Administrator') selected @endif>Administrator</option>
                    <option value="Operator" @if($user->role == 'Operator') selected @endif>Operator</option>
                </select>
			</div>
		</div>
        <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label text-white">Gambar</label>
			<div class="col-sm-12 col-md-10">
                <img class="product" width="200" height="200" @if($user->gambar) src="{{ asset('storage/'.$user->gambar) }}" @endif />
				<input class="uploads form-control" type="file" style="margin-top: 20px;" name="gambar" ></br>
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
