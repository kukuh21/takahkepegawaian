@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Profil</h1>
</div>

<form action="{{ route('updateProfile', auth()->user()->id ) }}" method="POST" id="form-input" class="form-horizontal">
  {{ csrf_field() }} {{ method_field('PUT') }}
  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="row col-12" style="margin-top: 15px;">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" value="{{ auth()->user()->nama }}" autocomplete="off" required>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" autocomplete="off" required>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" id="username" value="{{ auth()->user()->username }}" autocomplete="off" required>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <a href="{{ url('/home') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Kembali</a>
          <button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Simpan</button>
        </div>

      </div>

    </div>
  </div>
</form>
@endsection
