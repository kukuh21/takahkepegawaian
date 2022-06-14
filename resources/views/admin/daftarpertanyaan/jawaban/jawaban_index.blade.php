@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Jawaban</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <h5 class="text-center mt-2">{{ $pertanyaan->pertanyaan_nama }}</h5>
      <div class="card-header">
        <a onclick="tambah_jawaban()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
        <a href="{{ route('daftarpertanyaan.index') }}" class="btn btn-danger ml-2"><i class="fa fa-undo"></i> Kembali</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Jawaban</th>
                <th>Poin</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('admin.daftarpertanyaan.jawaban.modal.modal_jawaban')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  <script>
    function tambah_jawaban()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modaljawaban').modal('show');
        $('#modaljawaban form')[0].reset();
        $('.modal-title').text('Tambah Jawaban');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit_jawaban(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modaljawaban form')[0].reset();
      $.ajax({
        url : "{{ url('daftarpertanyaan/editJawaban/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modaljawaban').modal('show');
          $('.modal-title').text('Edit Jawaban');

          $('#id').val(data.jawaban_id);
          $('#jawaban').val(data.jawaban_nama);
          $('#poin').val(data.jawaban_poin);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  $(function() {
    var table;
    var pertanyaan_id = $('#pertanyaan_id').val();

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ url('daftarpertanyaan/dataJawaban/') }}/" + pertanyaan_id,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'jawaban_nama'},
            { data: 'jawaban_poin'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modaljawaban form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('daftarpertanyaan.storeJawaban') }}";
            else url = "{{ url('daftarpertanyaan/updateJawaban/') }}/" + id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modaljawaban form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modaljawaban').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modaljawaban').modal('hide');
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