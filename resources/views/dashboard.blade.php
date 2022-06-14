@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Dashboard</h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <center><img style="margin-top: 10px;" src="{{ asset('logo-tabalong.png') }}" alt="" width="100px;"></center>
      <h3 class="text-center" style="margin-top: 10px; margin-bottom: 10px;">Selamat Datang Di {{ config('app.meta') }}</h3>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="far fa-folder"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Folder</h4>
        </div>
        <div class="card-body">
          {{ $folder }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-info">
        <i class="far fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Berkas</h4>
        </div>
        <div class="card-body">
          {{ $berkas }}
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
