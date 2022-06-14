@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Pengaturan</h1>
</div>

<form action="{{ route('pengaturan.updateLayoutIKM', $ikm->ikm_id) }}" method="POST" id="form-page-1" class="form-horizontal form-page" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h6 class="text-center" style="padding-top: 20px;">Atur Layout IKM</h6>
          <div class="row col-12">
            <div class="col-md-12">
              <p>Silakan Rubah Layout Backround IKM</p>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gambar Background</label>
                <input type="file" class="form-control" name="ikm_background" id="ikm_background" autocomplete="off">
                <button type="submit" class="btn btn-info mt-15"><i class="far fa-save"></i> Update</button>
                <a class="btn btn-danger mt-15" href="{{ route('pengaturan.index') }}"><i class="fa fa-undo"></i> Kembali</a>
              </div>
            </div>
            <div class="col-md-6" style="text-align: center;">
              <div class="form-group">
                <img src="{{ isset($ikm->ikm_background) ? asset('assets/img/'.$ikm->ikm_background) : asset('assets/img/bg-3.jpg') }}" alt="" width="45%">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
</form>


<form action="{{ route('pengaturan.updateLayoutIKM', $ikm->ikm_id) }}" method="POST" id="form-page-1" class="form-horizontal form-page" enctype="multipart/form-data">
  {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h6 class="text-center" style="padding-top: 20px;">Atur Layout Slide IKM</h6>
          <div class="row col-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Slide 1</label>
                <input type="file" class="form-control" name="ikm_slide1" id="ikm_slide1" autocomplete="off">
              </div>
            </div>
            <div class="col-md-3" style="text-align: center;">
              <div class="form-group">
                <img src="{{ isset($ikm->ikm_slide1) ? asset('assets/img/'.$ikm->ikm_slide1) : asset('assets/img/1114.png') }}" alt="" width="85%">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Slide 2</label>
                <input type="file" class="form-control" name="ikm_slide2" id="ikm_slide2" autocomplete="off">
              </div>
            </div>
            <div class="col-md-3" style="text-align: center;">
              <div class="form-group">
                <img src="{{ isset($ikm->ikm_slide2) ? asset('assets/img/'.$ikm->ikm_slide2) : asset('assets/img/2479229.png') }}" alt="" width="85%">
              </div>
            </div>

            <div class="col-md-6" style="margin-bottom: 10px;">
              <button type="submit" class="btn btn-info mt-15"><i class="far fa-save"></i> Update</button>
              <a class="btn btn-danger mt-15" href="{{ route('pengaturan.index') }}"><i class="fa fa-undo"></i> Kembali</a>
            </div>

          </div>

        </div>
      </div>
    </div>
</form>

@endsection

@section('script')
{!! $JsValidatorIKM->selector('.form-page') !!}
@endsection