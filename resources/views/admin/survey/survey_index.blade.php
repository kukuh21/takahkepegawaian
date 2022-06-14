@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Survey</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a onclick="export_data()" style="margin-left: 5px;" class="btn btn-success text-white"><i class="fa fa-file-excel"></i> Export Excel</a>
        <a onclick="print_hasil()" style="margin-left: 5px;" class="btn btn-danger text-white"><i class="fa fa-file-pdf"></i> Print Data Hasil Survey Per Layanan</a>
        <a onclick="print_hasil_seluruh()" style="margin-left: 5px;" class="btn btn-primary text-white"><i class="fa fa-file-pdf"></i> Print Data Hasil Survey Keseluruhan</a>
        <a href="{{ route('survey.formatpublikasi') }}" style="margin-left: 5px;" class="btn btn-info text-white"><i class="fa fa-bars"></i> Format Publikasi</a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control fdate" placeholder="Tanggal Awal" autocomplete="off" id="tanggal_awal">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control fdate" placeholder="Tanggal Akhir" autocomplete="off" id="tanggal_akhir">
            </div>
          </div>

          <div class="col-md-2">
            <a onclick="filter()" class="btn btn-primary text-white"><i class="fa fa-search"></i> Filter</a>
          </div>


        </div>

        <div class="col-md-12 mt-2">
          <h5 class="text-center">Total Nilai IKM</h5>
          <h4 class="text-center text-warning nilai"></h4>
          <center><img src="{{ asset('award.gif') }}" alt="" width="30%"></center>
        </div>

        <div class="col-md-12">

        </div>

      </div>

      <!-- Include Modal -->
      @include('admin.survey.modal.modal_export')
      @include('admin.survey.modal.modal_hasil')
      @include('admin.survey.modal.modal_hasil_keseluruhan')
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <h2 class="section-title">Nilai IKM Berdasarkan Pertanyaan</h2>

    <div class="row pertanyaan" id="pertanyaan">

    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h2 class="section-title">Nilai IKM Berdasarkan Layanan</h2>

    <div class="row layanan" id="layanan">

    </div>
  </div>
</div>


@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $.ajax({
          url : "{{ url('survey/nilai_ikm/0/0') }}",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('.nilai').text(data);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
        });

        // Pertanyaan
        var url_pertanyaan = "{{ url('survey/nilai_ikm_pertanyaan/0/0') }}";
        fetch(url_pertanyaan).then(response => response.json())
          .then(function(data) {
              var template = data.map(post => {
                  return `
                  <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                      <div class="article-header">
                        <img class="article-image" style="width: 100%; object-fit:cover; object-position:center;" src="{{ asset('assets/img/pricing-free.png') }}">
                      </div>
                      <div class="article-details">
                        <p style="min-height: 150px;">${post.pertanyaan_nama}</p>
                        <div class="article-cta">
                          <a href="{{ url('survey/view_ikm_pertanyaan/${post.pertanyaan_id}') }}" class="btn btn-primary nilai_pertanyaan" style="min-width: 100px;">${post.hasil}</a>
                        </div>
                      </div>
                    </article>
                  </div>
                  `;
              });

              document.getElementById("pertanyaan").innerHTML = template.join('');
          }).catch(function(e){
              console.log(e);
          });

          // Layanan
          var url_layanan = "{{ url('survey/nilai_ikm_layanan/0/0') }}";
          fetch(url_layanan).then(response => response.json())
            .then(function(data) {
                var template = data.map(post => {
                    return `
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                      <article class="article">
                        <div class="article-header">
                          <img class="article-image" style="width: 100%; object-fit:cover; object-position:center;" src="{{ asset('assets/img/layanan.jpg') }}">
                        </div>
                        <div class="article-details">
                          <p style="min-height: 80px; text-align: center; font-weight:bold;">${post.jenislayanan_nama}</p>
                          <div class="article-cta">
                            <a href="#" class="btn btn-primary nilai_layanan" style="min-width: 100px;">${post.hasil}</a>
                          </div>
                        </div>
                      </article>
                    </div>
                    `;
                });

                document.getElementById("layanan").innerHTML = template.join('');
            }).catch(function(e) {
                console.log(e);
            });

    });

    function export_data() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modalexport').modal('show');
      $('#modalexport form')[0].reset();
      $('.title').text('Export Data');
    }

    function print_hasil() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modalhasil').modal('show');
      $('#modalhasil form')[0].reset();
      $('.title').text('Print Data');
    }

    function print_hasil_seluruh() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modalhasilsemua').modal('show');
      $('#modalhasilsemua form')[0].reset();
    }


    function filter()
    {
      let tanggal_awal = $('#tanggal_awal').val();
      let tanggal_akhir = $('#tanggal_akhir').val();

      $.ajax({
          url : "{{ url('survey/nilai_ikm/') }}/" + tanggal_awal + '/' + tanggal_akhir,
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('.nilai').text(data);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });


      var url_pertanyaan = "{{ url('survey/nilai_ikm_pertanyaan/') }}/" + tanggal_awal + '/' + tanggal_akhir;
        fetch(url_pertanyaan).then(response => response.json())
          .then(function(data) {
              var template = data.map(post => {
                  return `
                  <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                      <div class="article-header">
                        <img class="article-image" style="width: 100%; object-fit:cover; object-position:center;" src="{{ asset('assets/img/pricing-free.png') }}">
                      </div>
                      <div class="article-details">
                        <p style="min-height: 150px;">${post.pertanyaan_nama}</p>
                        <div class="article-cta">
                          <a href="{{ url('survey/view_ikm_pertanyaan/${post.pertanyaan_id}') }}" class="btn btn-primary nilai_pertanyaan" style="min-width: 100px;">${post.hasil}</a>
                        </div>
                      </div>
                    </article>
                  </div>
                  `;
              });

              document.getElementById("pertanyaan").innerHTML = template.join('');
          }).catch(function(e){
              console.log(e);
          });


      var url_layanan = "{{ url('survey/nilai_ikm_layanan/') }}/" + tanggal_awal + '/' + tanggal_akhir;
        fetch(url_layanan).then(response => response.json())
          .then(function(data) {
              var template = data.map(post => {
                  return `
                  <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                      <div class="article-header">
                        <img class="article-image" style="width: 100%; object-fit:cover; object-position:center;" src="{{ asset('assets/img/layanan.jpg') }}">
                      </div>
                      <div class="article-details">
                        <p style="min-height: 150px;">${post.jenislayanan_nama}</p>
                        <div class="article-cta">
                          <a href="#" class="btn btn-primary nilai_layanan" style="min-width: 100px;">${post.hasil}</a>
                        </div>
                      </div>
                    </article>
                  </div>
                  `;
              });

              document.getElementById("layanan").innerHTML = template.join('');
          }).catch(function(e){
              console.log(e);
          });

    }
  </script>
@endsection