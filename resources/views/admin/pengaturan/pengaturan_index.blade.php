@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Pengaturan</h1>
</div>
<form action="{{ route('pengaturan.updateInstansi', $instansi->instansi_id ) }}" method="POST" id="form-instansi" class="form-horizontal" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('PUT') }}
  <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h6 class="text-center" style="padding-top: 20px;">Instansi</h6>
          <div class="row col-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Instansi</label>
                <input type="text" class="form-control" name="instansi_nama" id="instansi_nama" value="{{ $instansi->instansi_nama }}" autocomplete="off">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Instansi Singkatan</label>
                <input type="text" class="form-control" name="instansi_singkatan" id="instansi_singkatan" value="{{ $instansi->instansi_singkatan }}" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Deskripsi Aplikasi</label>
                <input type="text" name="instansi_deskripsi" id="instansi_deskripsi" class="form-control" value="{{ $instansi->instansi_deskripsi }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Gambar Barcode</label>
                <input type="file" class="form-control" name="instansi_barcode" id="instansi_barcode" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4">
              <img width="80" src="{{ isset($instansi->instansi_barcode) ? asset('images/barcode/'.$instansi->instansi_barcode) : asset('logo-tabalong.png') }}" alt="">
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-info"><i class="far fa-save"></i> Update</button>
          </div>

        </div>

      </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <h6 class="text-center" style="padding-top: 20px;">Atur Layout Home</h6>
      <div class="col-md-12" style="text-align: center;">
        <img src="{{ asset('images/home_format.PNG') }}" alt="" width="25%">
      </div>
      <div style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
        <a class="btn btn-info" href="{{ route('pengaturan.layouthome') }}"><i class="fa fa-angle-double-right"></i> Atur</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <h6 class="text-center" style="padding-top: 20px;">Atur Layout IKM</h6>
      <div class="col-md-12" style="text-align: center;">
        <img src="{{ asset('images/ikm_format.PNG') }}" alt="" width="25%">
      </div>
      <div style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
        <a class="btn btn-info" href="{{ route('pengaturan.layoutIKM') }}"><i class="fa fa-angle-double-right"></i> Atur</a>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  {!! $JsValidatorInstansi->selector('#form-instansi') !!}
@endsection

@section('content')

@endsection

@section('script')
  {!! $JsValidatorInstansi->selector('#form-instansi') !!}
@endsection