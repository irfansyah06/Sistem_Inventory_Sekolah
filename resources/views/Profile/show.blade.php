@extends('layouts.MasterView')
@section('menu_home', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
            <div class="pd-20 card-box height-100-p" style="padding-left: 130px">
                <img height="230" width="230" @if($user->gambar) src="{{ asset('storage/'.$user->gambar) }}" @endif />
            </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 25px">
                            <label for="name" class="col-sm-10 col-md-3 col-form-label text-white">Nama</label>
                            <div class="col-md-8 col-sm-12">
                                <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" aria-describedby="name" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 25px">
                            <label for="username" class="col-sm-10 col-md-3 col-form-label text-white">Username</label>
                            <div class="col-md-8 col-sm-12">
                                <input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}" aria-describedby="name" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 25px">
                            <label for="email" class="col-sm-10 col-md-3 col-form-label text-white">Email</label>
                            <div class="col-md-8 col-sm-12">
                                <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" aria-describedby="email" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 25px">
                            <label for="role" class="col-sm-10 col-md-3 col-form-label text-white">Role</label>
                            <div class="col-md-8 col-sm-12">
                                <input class="form-control" type="text" name="role" id="role" value="{{ $user->role }}" aria-describedby="role" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="{{url('/')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
