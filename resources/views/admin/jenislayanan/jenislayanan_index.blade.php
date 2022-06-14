@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Bidang</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a onclick="tambah_bidang()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Nama Bidang</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('admin.jenislayanan.modal.modal_bidang')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  <script>
    function tambah_bidang()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalbidang').modal('show');
        $('#modalbidang form')[0].reset();
        $('.modal-title').text('Tambah Bidang');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit_bidang(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modalbidang form')[0].reset();
      $.ajax({
        url : "{{ url('jenislayanan/editBidang/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modalbidang').modal('show');
          $('.modal-title').text('Edit Bidang');

          $('#id').val(data.bidang_id);
          $('#nama_bidang').val(data.bidang_nama);
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
        ajax: '{!! route('jenislayanan.dataBidang') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'bidang_nama'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modalbidang form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('jenislayanan.storeBidang') }}";
            else url = "{{ url('jenislayanan/updateBidang/') }}/" + id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modalbidang form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modalbidang').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modalbidang').modal('hide');
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