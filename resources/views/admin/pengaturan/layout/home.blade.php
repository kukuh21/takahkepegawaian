@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Pengaturan</h1>
</div>

<form action="{{ route('pengaturan.updateLayoutHome', $home->home_id) }}" method="POST" id="form-page-1" class="form-horizontal form-page" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h6 class="text-center" style="padding-top: 20px;">Atur Layout Home</h6>
          <div class="row col-12">
            <div class="col-md-12">
              <h6 class="text-bold">Page 1</h6>
              <p>"Pada Page 1 Ini Silakan Ubah Gambar, Pada Page Utama Sesuai Keinginan Anda. Ukuran Gambar Yang Ideal Adalah 539 x 438"</p>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="home_gambar_1" id="home_gambar_1" autocomplete="off">
                <button type="submit" class="btn btn-info mt-15"><i class="far fa-save"></i> Update</button>
                <a class="btn btn-danger mt-15" href="{{ route('pengaturan.index') }}"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </div>
            <div class="col-md-6" style="text-align: center;">
              <div class="form-group">
                <img src="{{ isset($home->home_gambar_1) ? asset('assets/img/'.$home->home_gambar_1) : asset('assets/img/hero-img.png') }}" alt="" width="45%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>

<form action="{{ route('pengaturan.updateLayoutHome', $home->home_id) }}" method="POST" id="form-page-1" class="form-horizontal form-page" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="row col-12">
            <div class="col-md-12 mt-15">
              <h6 class="text-bold">Page 2</h6>
              <p>"Pada Page 2 Ini Silakan Ubah Gambar dan Ubah Deskripsi Sesuai Keinginan Anda. Ukuran Gambar Yang Ideal Adalah 539 x 438"</p>
            </div>

            <div class="col-md-6" style="text-align: center;">
              <div class="form-group">
                <img src="{{ isset($home->home_gambar_2) ? asset('assets/img/'.$home->home_gambar_2) : asset('assets/img/hero-img.png') }}" alt="" width="45%">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="home_judul" id="home_judul" autocomplete="off" value="{{ $home->home_judul }}">
              </div>

              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="home_deskripsi" id="home_deskripsi" style="height: 100px;">{{ $home->home_deskripsi }}</textarea>
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="home_gambar_2" id="home_gambar_2" autocomplete="off">
                <button type="submit" class="btn btn-info mt-15"><i class="far fa-save"></i> Update</button>
                <a class="btn btn-danger mt-15" href="{{ route('pengaturan.index') }}"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</form>

@endsection

@section('script')
{!! $JsValidatorHome->selector('.form-page') !!}
@endsection