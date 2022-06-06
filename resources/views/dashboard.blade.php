@extends('layouts.MasterView')
@section('menu_home', 'active')
@section('content')
<div class="card-box pd-20 height-100-p mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="{{asset('templete/vendors/images/banner-img.png')}}" alt="">
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize text-white">
                Welcome To Sistem Inventroy Sekolah <div class="weight-600 font-30 text-blue">{{Auth::user()->name}}</div>
            </h4>
            <p class="font-18 max-width-600 text-white">Semua hal akan lebih mudah, praktis, dan efisien dengan menggunakan sistem.
                Lindungi barang fasilitas sekolah kita dengan pendataan yang terstruktur dalam Sistem Inventory Sekolah ! ! !</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/kategori.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$kategori->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Total Kategori</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/barang.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$barang->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Nama Barang</div>
                </div>
            </div>
        </div>
    </div>
    @can('manage-MasterData')
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/supplier.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$supplier->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Total Supplier</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/users.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$user->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Jumlah User</div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('manage-transaksi')
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/keluar.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$BarangKeluar->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Barang Keluar</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center" style="padding-left: 15px;">
                <div class="progress-data">
                    <img src="{{asset('templete/vendors/images/masuk.png')}}" alt="">
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0 text-white text-center">{{$BarangMasuk->count()}}</div>
                    <div class="weight-600 font-14 text-white text-center">Barang Masuk</div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
