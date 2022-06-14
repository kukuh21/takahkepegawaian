@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Daftar Berkas</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <h3 class="text-center" style="margin-top: 20px;">{{ $data->folder_nama }}</h3>
      <div class="card-header">
        <a onclick="tambah()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
        <a href="{{ route('folder.index') }}" class="btn btn-danger text-white" style="margin-left: 10px;"><i class="fa fa-undo"></i> Kembali</a>
      </div>
      <div class="card-body">
        <input type="hidden" id="folder_id" value="{{ $data->folder_id }}">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Nama Berkas</th>
                <th>File</th>
                <th width="100">Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('berkas.modal.modal_berkas')
      @include('berkas.modal.modal_edit')

    </div>
  </div>

</div>


@endsection

@section('active-berkas')
  active
@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  {!! $JsValidatorEdit->selector('#form-edit') !!}

  <script>
    function tambah()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalberkas').modal('show');
        $('#modalberkas form')[0].reset();
        $('.modal-title').text('Tambah Berkas');
        $('#simpan').show();
        $('#loading').hide();
        $(".progress").hide();
    }

    function edit(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $(".progress").hide();
      $('#modalberkas form')[0].reset();
      $.ajax({
        url : "{{ url('berkas/editJson/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modalberkas').modal('show');
          $('.modal-title').text('Edit Berkas');

          $('#id').val(data.berkas_id);
          $('#nama_berkas').val(data.berkas_nama);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  function rename(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan-edit').show();
      $('#loading-edit').hide();
      $('#modaledit form')[0].reset();
      $.ajax({
        url : "{{ url('berkas/editJson/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modaledit').modal('show');
          $('.modal-title-edit').text('Edit Nama Berkas');

          $('#id-berkas').val(data.berkas_id);
          $('#nama_berkas_edit').val(data.berkas_nama);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  $(function() {
    var table;

    var folder = $('#folder_id').val();

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ url('berkas/data/') }}/" + folder,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'berkas_nama'},
            { data: 'file', orderable: false, searchable: false},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });



    $('#modalberkas form').on("submit", function (e) {
            if(!e.isDefaultPrevented()){
                $(".progress").show();
                $('#simpan').hide();
                $('#loading').show();
                var formData = new FormData(this);
                var id = $('#id').val();
                if(save_method == "add") url = "{{ url('berkas/storeJson') }}";
                else url = "{{ url('/berkas/updateJson/') }}/" + id;

                $.ajax({
                url : url,
                type : "POST",
                data : formData,
                contentType: false,
                processData: false,
                success : function(data, jqXHR) {
                    var data = jqXHR.responseJSON;
                    $('#modalberkas').modal('hide');
                    toastr.success('Sukses', 'Gambar Berhasil Diupload', {
                        onHidden: function () {
                            table.ajax.reload();
                        }
                    })
                },
                error : function(){
                    toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
                },
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.onprogress = function (e) {
                        $(".progress-bar").attr("style", "width:" + Math.floor(e.loaded / e.total * 100) + "%");
                        $(".progress-bar").html(Math.floor(e.loaded / e.total * 100) + "%");
                    };
                    return xhr;
                }
                });
                return false;
            }
      });

      $('#modaledit form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id_berkas = $('#id-berkas').val();
            $('#simpan-edit').hide();
            $('#loading-edit').show();
            url = "{{ url('/berkas/updateNamaJson/') }}/" + id_berkas;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modaledit form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modaledit').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modaledit').modal('hide');
                  toastr.error('Error', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
              },
              error : function(){
                toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server');
              }
            });
            return false;
        }
      });

    });

  </script>


@endsection