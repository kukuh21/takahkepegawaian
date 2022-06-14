@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Daftar Folder</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a onclick="tambah()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Nama Folder</th>
                <th width="100">Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('folder.modal.modal_folder')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}

  <script>
    function tambah()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalfolder').modal('show');
        $('#modalfolder form')[0].reset();
        $('.modal-title').text('Tambah Folder');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modalfolder form')[0].reset();
      $.ajax({
        url : "{{ url('folder/editJson/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modalfolder').modal('show');
          $('.modal-title').text('Edit Folder');

          $('#id').val(data.folder_id);
          $('#nama_folder').val(data.folder_nama);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  $(function() {
    var table;

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! route('folder.data') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'folder_nama'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modalfolder form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('folder.store') }}";
            else url = "folder/"+id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modalfolder form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modalfolder').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modalfolder').modal('hide');
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