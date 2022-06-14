@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Daftar Pertanyaan</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a onclick="tambah_pertanyaan()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Nama Pertanyaan</th>
                <th>Singkatan</th>
                <th width="100">Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('admin.daftarpertanyaan.modal.modal_daftarpertanyaan')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  <script>
    function tambah_pertanyaan()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalpertanyaan').modal('show');
        $('#modalpertanyaan form')[0].reset();
        $('.modal-title').text('Tambah Pertanyaan');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit_pertanyaan(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modalpertanyaan form')[0].reset();
      $.ajax({
        url : "{{ url('daftarpertanyaan/editJson/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modalpertanyaan').modal('show');
          $('.modal-title').text('Edit Pertanyaan');

          $('#id').val(data.pertanyaan_id);
          $('#nama_pertanyaan').val(data.pertanyaan_nama);
          $('#singkatan').val(data.pertanyaan_singkatan);
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
        ajax: '{!! route('daftarpertanyaan.data') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'pertanyaan_nama'},
            { data: 'pertanyaan_singkatan'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modalpertanyaan form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('daftarpertanyaan.store') }}";
            else url = "daftarpertanyaan/"+id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modalpertanyaan form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modalpertanyaan').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modalpertanyaan').modal('hide');
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