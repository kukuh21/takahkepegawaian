@extends('layouts.content')

@section('content')
<div class="section-header">
  <h1>Survey Pertanyaan</h1>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="card">
      <h5 class="text-center mt-2">{{ $data->pertanyaan_nama }}</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <input type="hidden" name="pertanyaan_id" id="pertanyaan_id" value="{{ $data->pertanyaan_id }}">
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
        </div>

        <div class="row">
          <div class="col-md-12">
              <!-- HTML -->
              <div id="chartdiv" style="width:100%;height:300px;"></div>
              <!-- END CONTENT -->
          </div>
        </div>

      </div>

      <!-- Include Modal -->

    </div>
  </div>

</div>


@endsection

@section('script')
  <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

  <script>
    $(document).ready(function() {

      $.ajax({
          url : "{{ url('survey/nilai_view_ikm_pertanyaan/0/0/') }}/" + $('#pertanyaan_id').val(),
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('.nilai').text(data);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
      });
    });


  </script>

<script>
  // am4core.ready(function() {

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  var chart = am4core.create("chartdiv", am4charts.PieChart);

  // chart.data =

 // Add and configure Series
  var pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "litres";
  pieSeries.dataFields.category = "country";
  pieSeries.slices.template.stroke = am4core.color("#fff");
  pieSeries.slices.template.strokeOpacity = 1;

  // This creates initial animation
  pieSeries.hiddenState.properties.opacity = 1;
  pieSeries.hiddenState.properties.endAngle = -90;
  pieSeries.hiddenState.properties.startAngle = -90;

  chart.hiddenState.properties.radius = am4core.percent(0);

  // }); // end am4core.ready()

  $.ajax({
          url : "{{ url('survey/data_pertanyaan_layanan/0/0/') }}/" +  $('#pertanyaan_id').val(),
          type : "GET",
          dataType : "JSON",
          success : function(data){
            chart.data = data
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
  });

  function filter()
  {
        $.ajax({
            url : "{{ url('survey/nilai_view_ikm_pertanyaan/') }}/" + $('#tanggal_awal').val() + '/' + $('#tanggal_akhir').val() + '/' + $('#pertanyaan_id').val(),
            type : "GET",
            dataType : "JSON",
            success : function(data){
              $('.nilai').text(data);
            },
            error : function(){
              toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
            }
        });

        $.ajax({
          url : "{{ url('survey/data_pertanyaan_layanan/') }}/" + $('#tanggal_awal').val() + '/' + $('#tanggal_akhir').val() + '/' + $('#pertanyaan_id').val(),
          type : "GET",
          dataType : "JSON",
          success : function(data){
            chart.data = data
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
        });

    }

</script>
@endsection