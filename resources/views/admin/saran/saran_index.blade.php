@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Saran</h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <a onclick="export_data()" style="margin-left: 5px;" class="btn btn-success text-white"><i class="fa fa-file-excel"></i> Export Excel</a>
        </div>
         <div class="card-body">
          <table class="table table-bordered table-hover table-striped" id="datatable" width="100%">
            <thead>
              <tr class="text-center">
                <th width="20">No.</th>
                <th width="180">Status</th>
                <th width="180">NIP</th>
                <th>Nama</th>
                <th>Saran</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
      </div>

      <!-- Include Modal -->
      @include('admin.saran.modal.modal_export')
    </div>
  </div>

</div>

@endsection
@section('script')
  <script>

  $(function() {
    var table;

    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! route('saranadmin.data') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'status_responden'},
            { data: 'status_no'},
            { data: 'status_nama'},
            { data: 'saran_isi'}
        ],
        columnDefs: [
          {
              "targets": 0, // your case first column
              "className": "text-center"
          },
        ],
    });



    });


    function export_data() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modalexport').modal('show');
      $('#modalexport form')[0].reset();
      $('.title').text('Export Data');
    }

  </script>

@endsection
