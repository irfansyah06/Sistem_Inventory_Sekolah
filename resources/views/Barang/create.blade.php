@extends('layouts.MasterView')
@section('menu_barang', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Barang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
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
	<form method="POST" action="{{ route('barang.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
		<div class="form-group row">
			<label for="kode_barang" class="col-sm-12 col-md-2 col-form-label text-white">Kode Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode_barang" id="kode_barang" aria-describedby="kode_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="nama_barang" class="col-sm-12 col-md-2 col-form-label text-white">Nama Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_barang" id="nama_barang" aria-describedby="nama_barang" placeholder="">
			</div>
		</div>
        <div class="form row">
			<label for="id_kategori" class="col-sm-12 col-md-2 col-form-label text-white">Kategori</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="kategori_nama" type="text" class="form-control" readonly="" required>
                    <input id="id_kategori" type="hidden" name="id_kategori" value="{{ ('id_kategori') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Kategori </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="id_supplier" class="col-sm-12 col-md-2 col-form-label text-white">Supplier</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="supplier_nama" type="text" class="form-control" readonly="" required>
                    <input id="id_supplier" type="hidden" name="id_supplier" value="{{ ('id_supplier') }}" required readonly="">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Supplier </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
		<div class="form-group row">
			<label for="jumlah_barang" class="col-sm-12 col-md-2 col-form-label text-white">Jumlah</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="jumlah_barang" id="jumlah_barang" aria-describedby="jumlah_barang" placeholder="">
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
                    <a href="{{route('barang.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->

<!-- Modal Kategori -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $data)
                        <tr class="pilih_kategori" data-id_kategori="<?php echo $data->id; ?>" data-kategori_nama="<?php echo $data->nama_kategori; ?>" >
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->kode_kategori}}</td>
                            <td>{{$data->nama_kategori}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Kategori -->

<!-- Modal Supplier -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Supplier</th>
                            <th>Nama</th>
                            <th>Penyedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplier as $data)
                        <tr class="pilih_supplier" data-id_supplier="<?php echo $data->kode; ?>" data-supplier_nama="<?php echo $data->nama; ?>" >
                            <td>{{$data->kode}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->penyedia}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Supplier -->

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.pilih_kategori', function (e) {
        document.getElementById("kategori_nama").value = $(this).attr('data-kategori_nama');
        document.getElementById("id_kategori").value = $(this).attr('data-id_kategori');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih_supplier', function (e) {
        document.getElementById("supplier_nama").value = $(this).attr('data-supplier_nama');
        document.getElementById("id_supplier").value = $(this).attr('data-id_supplier');
        $('#myModal2').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2").dataTable();
    });
</script>
@endsection
