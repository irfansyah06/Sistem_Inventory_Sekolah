@extends('layouts.MasterView')
@section('menu_BarangKeluar', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Data Barang Keluar</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('BarangKeluar.index') }}">Barang Keluar</a></li>
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
	<form method="POST" action="{{ route('BarangKeluar.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
		<div class="form-group row">
			<label for="kode" class="col-sm-12 col-md-2 col-form-label text-white">Kode Out</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode" id="kode" aria-describedby="kode" value="{{$code}}" placeholder readonly="">
			</div>
		</div>
        <div class="form row">
			<label for="id_barang" class="col-sm-12 col-md-2 col-form-label text-white">Barang</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="barang_nama" type="text" class="form-control" readonly="" required>
                    <input id="id_barang" type="hidden" name="id_barang" value="{{ old('id_barang') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Barang </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
		<div class="form-group row">
			<label for="jumlah" class="col-sm-12 col-md-2 col-form-label text-white">Jumlah</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="jumlah" id="jumlah" aria-describedby="jumlah" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="penanggung_jawab" class="col-sm-12 col-md-2 col-form-label text-white">Penaggung Jawab</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="penanggung_jawab" id="penanggung_jawab" aria-describedby="penanggung_jawab" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="tgl_keluar" class="col-sm-12 col-md-2 col-form-label text-white">Tgl Keluar</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="date" name="tgl_keluar" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" id="tgl_keluar" aria-describedby="tgl_keluar" placeholder=""></br>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('BarangKeluar.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $data)
                        <tr class="pilih" data-id_barang="<?php echo $data->id; ?>" data-barang_nama="<?php echo $data->nama_barang; ?>" >
                            <td>{{$data->kode_barang}}</td>
                            <td>{{$data->kategori->nama_kategori}}</td>
                            <td>{{$data->nama_barang}}</td>
                            <td>{{$data->jumlah_barang}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
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
    $(document).on('click', '.pilih', function (e) {
        document.getElementById("barang_nama").value = $(this).attr('data-barang_nama');
        document.getElementById("id_barang").value = $(this).attr('data-id_barang');
        $('#myModal').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2").dataTable();
    });
</script>
@endsection
