@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Sub Bidang</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <h5 class="text-center mt-2">{{ $bidang->bidang_nama }}</h5>
      <div class="card-header">
        <a onclick="tambah_subbidang()" class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah</a>
        <a href="{{ route('jenislayanan.index') }}" class="btn btn-danger ml-2"><i class="fa fa-undo"></i> Kembali</a>
      </div>
      <div class="card-body">
        {{-- <div class=""> --}}
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th>Nama Sub Bidang</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        {{-- </div> --}}
      </div>

      <!-- Include Modal -->
      @include('admin.jenislayanan.subbidang.modal.modal_subbidang')

    </div>
  </div>

</div>


@endsection

@section('script')
  {!! $JsValidator->selector('#form-input') !!}
  <script>
    function tambah_subbidang()
    {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalsubbidang').modal('show');
        $('#modalsubbidang form')[0].reset();
        $('.modal-title').text('Tambah Sub Bidang');
        $('#simpan').show();
        $('#loading').hide();
    }

    function edit_subbidang(id){
      save_method = "edit";
      $('input[name=_method]').val('PATCH');
      $('#simpan').show();
      $('#loading').hide();
      $('#modalsubbidang form')[0].reset();
      $.ajax({
        url : "{{ url('jenislayanan/editSubBidang/') }}/" + id,
        type : "GET",
        dataType : "JSON",
        success : function(data){
          $('#modalsubbidang').modal('show');
          $('.modal-title').text('Edit Sub Bidang');

          $('#id').val(data.subbidang_id);
          $('#nama_sub_bidang').val(data.subbidang_nama);
        },
        error : function(){
          toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
        }
      });
  }

  $(function() {
    var table;
    var bidang_id = $('#bidang_id').val();

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ url('jenislayanan/dataSubBidang/') }}/" + bidang_id,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'subbidang_nama'},
            { data: 'action', actions: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });


      $('#modalsubbidang form').validator().on('submit', function(e) {
          if(!e.isDefaultPrevented()) {
            var id = $('#id').val();
            $('#simpan').hide();
            $('#loading').show();
            if(save_method == "add") url = "{{ route('jenislayanan.storeSubBidang') }}";
            else url = "{{ url('jenislayanan/updateSubBidang/') }}/" + id;
            $.ajax({
              url : url,
              type : "POST",
              data : $('#modalsubbidang form').serialize(),
              success : function(data) {
                if(data.code === 200) {
                  $('#modalsubbidang').modal('hide');
                  toastr.success('Sukses', data.status, {
                    onHidden: function() {
                      table.ajax.reload();
                    }
                  })
                }
                if(data.code === 400) {
                  $('#modalsubbidang').modal('hide');
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