@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Survey</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('survey.index') }}" style="margin-left: 5px;" class="btn btn-danger text-white"><i class="fa fa-undo"></i> Kembali</a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control fdate tanggal_awal" placeholder="Tanggal Awal" autocomplete="off" id="tanggal_awal">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control fdate tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off" id="tanggal_akhir">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <select name="jenislayanan_id" id="jenislayanan_id" class="form-control jenislayanan_id">
                <option value="0">Jenis Layanan</option>
                @foreach ($jenislayanan as $list)
                  <option value="{{ $list->jenislayanan_id }}">{{ $list->jenislayanan_nama }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <a onclick="filter()" class="btn btn-primary text-white"><i class="fa fa-search"></i> Filter</a>
          </div>


        </div>

      </div>

      <!-- Include Modal -->
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="row layanan" id="layanan">

      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
        <article class="article">
          <div class="article-details">
            <p style="text-align: center; font-weight:bold;">Nilai IKM</p>
            <h2 style="font-weight: bold; font-size: 80px;" class="text-center nilai-ikm"></h2>
            <h6 style="font-weight: bold; font-size: 40px;" class="text-center mutu"></h6>
          </div>
        </article>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
        <article class="article">
          <div class="article-details">
            <p style="text-align: center; font-weight:bold;">Responden</p>
            <table border="0" width="100%">
              <tr>
                <td width="100">Jumlah</td>
                <td width="20">:</td>
                <td class="jumlah"></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td class="jk"></td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td>:</td>
                <td class="sd"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="sltp"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="slta"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="d1"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="d2"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="d3"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="d4"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="s1"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="s2"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="s3"></td>
              </tr>
            </table>
          </div>
        </article>
      </div>

    </div>
  </div>
</div>


<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">

          {{-- IKM Unsur Pertanyaan --}}
          <div class="col-md-12">
            <h4 class="text-center">Nilai IKM Berdasarkan Unsur Pertanyaan</h4>

            <table class="table table-bordered table-hover table-striped" id="datatable_pertanyaan" width="100%">
              <thead>
                <tr class="text-center">
                  <th width="20">No.</th>
                  <th>Pertanyaan</th>
                  <th>Nilai</th>
                  <th width="120">Mutu</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>



          {{-- End IKM Unsur Pertanyaan --}}

          {{-- IKM Unsur Pelayanan --}}
          <div class="col-md-12">
            <h4 class="text-center">Nilai IKM Berdasarkan Unsur Layanan</h4>

            <table class="table table-bordered table-hover table-striped" id="datatable_layanan" style="width:100%">
              <thead>
                <tr class="text-center">
                  <th width="20">No.</th>
                  <th>Layanan</th>
                  <th>Nilai</th>
                  <th width="120">Mutu</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>

          </div>

          {{-- End IKM Unsur Pelayanan --}}

        </div>

      </div>

      <!-- Include Modal -->
    </div>
  </div>

</div>


@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $.ajax({
          url : "{{ url('survey/nilai_ikm_publikasi/0/0/0') }}",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('.nilai-ikm').text(data[0]);
            $('.jumlah').text(data[1] + ' Orang');
            $('.jk').text('Laki-Laki : ' + data[2] + ' Orang' + ' | Perempuan : ' + data[3] + ' Orang' );
            $('.sd').text('SD : ' + data[4] + ' Orang');
            $('.sltp').text('SLTP : ' + data[5] + ' Orang');
            $('.slta').text('SLTA : ' + data[6] + ' Orang');
            $('.d1').text('D1 : ' + data[7] + ' Orang');
            $('.d2').text('D2 : ' + data[8] + ' Orang');
            $('.d3').text('D3 : ' + data[9] + ' Orang');
            $('.d4').text('D4 : ' + data[10] + ' Orang');
            $('.s1').text('S1 : ' + data[11] + ' Orang');
            $('.s2').text('S2 : ' + data[12] + ' Orang');
            $('.s3').text('S3 : ' + data[13] + ' Orang');
            $('.mutu').text(data[14]);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });
    });

    $(function() {
      table_pertanyaan = $('#datatable_pertanyaan').DataTable({
        "processing" : true,
        "serverside" : true,
        'paging': false,
        "searching": false,
        "ajax" : {
          "url" : "{{ url('survey/nilai_ikm_publikasi_pertanyaan/0/0/0') }}",
          "type" : "GET"
        },
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'className': 'text-center',
        }]
      });

      table_pelayanan = $('#datatable_layanan').DataTable({
        "processing" : true,
        "serverside" : true,
        'paging': false,
        "searching": false,
        "ajax" : {
          "url" : "{{ url('survey/nilai_ikm_publikasi_layanan/0/0/0') }}",
          "type" : "GET"
        },
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'className': 'text-center',
        }]
      });

    });

    function filter()
    {
      let tanggal_awal = $('#tanggal_awal').val();
      let tanggal_akhir = $('#tanggal_akhir').val();
      let jenis_layanan = $('#jenislayanan_id').val();

      $.ajax({
          url : "{{ url('survey/nilai_ikm_publikasi/') }}/" + tanggal_awal + '/' + tanggal_akhir + '/' + jenis_layanan,
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('.nilai-ikm').text(data[0]);
            $('.jumlah').text(data[1] + ' Orang');
            $('.jk').text('Laki-Laki : ' + data[2] + ' Orang' + ' | Perempuan : ' + data[3] + ' Orang' );
            $('.sd').text('SD : ' + data[4] + ' Orang');
            $('.sltp').text('SLTP : ' + data[5] + ' Orang');
            $('.slta').text('SLTA : ' + data[6] + ' Orang');
            $('.d1').text('D1 : ' + data[7] + ' Orang');
            $('.d2').text('D2 : ' + data[8] + ' Orang');
            $('.d3').text('D3 : ' + data[9] + ' Orang');
            $('.d4').text('D4 : ' + data[10] + ' Orang');
            $('.s1').text('S1 : ' + data[11] + ' Orang');
            $('.s2').text('S2 : ' + data[12] + ' Orang');
            $('.s3').text('S3 : ' + data[13] + ' Orang');
            $('.mutu').text(data[14]);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });

      $.ajax({
          url : "{{ url('survey/nilai_ikm_publikasi_pertanyaan/') }}/" + tanggal_awal + '/' + tanggal_akhir + '/' + jenis_layanan,
          type : "get",
          dataType : "json",
          success: function(data) {
              table_pertanyaan.ajax.url("{{ url('/survey/nilai_ikm_publikasi_pertanyaan/') }}/" + tanggal_awal + "/" + tanggal_akhir + "/" + jenis_layanan).load();
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });

      $.ajax({
          url : "{{ url('survey/nilai_ikm_publikasi_layanan/') }}/" + tanggal_awal + '/' + tanggal_akhir + '/' + jenis_layanan,
          type : "get",
          dataType : "json",
          success: function(data) {
              table_pelayanan.ajax.url("{{ url('/survey/nilai_ikm_publikasi_layanan/') }}/" + tanggal_awal + "/" + tanggal_akhir + "/" + jenis_layanan).load();
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });

    }
  </script>
@endsection