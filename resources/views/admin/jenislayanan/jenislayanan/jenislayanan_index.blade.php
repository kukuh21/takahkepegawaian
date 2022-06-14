@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Jenis Layanan</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <h5 class="text-center mt-2">{{ $subbidang->subbidang_nama }}</h5>
      <div class="card-header">
        <a onclick="tambah_jenislayanan()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
        <a href="{{ route('jenislayanan.subBidang', $subbidang->bidang_id) }}" class="btn btn-danger ml-2"><i class="fa fa-undo"></i> Kembali</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Jenis Layanan</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('admin.jenislayanan.jenislayanan.modal.modal_jenislayanan')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  <script>
    function tambah_jenislayanan()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modaljenislayanan').modal('show');
        $('#modaljenislayanan form')[0].reset();
        $('.modal-title').text('Tambah Jenis Layanan');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit_jenislayanan(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modaljenislayanan form')[0].reset();
      $.ajax({
        url : "{{ url('jenislayanan/editJenisLayanan/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modaljenislayanan').modal('show');
          $('.modal-title').text('Edit Jenis Layanan');

          $('#id').val(data.jenislayanan_id);
          $('#jenis_layanan').val(data.jenislayanan_nama);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  $(function() {
    var table;
    var subbidang_id = $('#subbidang_id').val();

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ url('jenislayanan/dataJenisLayanan/') }}/" + subbidang_id,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'jenislayanan_nama'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modaljenislayanan form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('jenislayanan.storeJenisLayanan') }}";
            else url = "{{ url('jenislayanan/updateJenisLayanan/') }}/" + id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modaljenislayanan form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modaljenislayanan').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modaljenislayanan').modal('hide');
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