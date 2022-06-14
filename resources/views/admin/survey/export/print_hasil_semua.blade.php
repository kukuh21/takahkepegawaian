<!DOCTYPE html>
<html>
  <body>
    <style type="text/css">
        .header {

        }

        .logo {
          border-radius: 100em;
          height: 20px;
          float: left;
        }

        .logokanan {
          border-radius: 100em;
          opacity: 0,5;
          height: 20px;
          float: right;
          padding-top: 28px;
        }

        .judul {
          border-top: 2px solid black;
          border-bottom: 2px solid black;
        }

        .title {
          margin-top: 0px;
          font-family: Arial;
        }

        h4 hr {
          border-bottom: 3px solid black;
        }

        .tabel {
          border-collapse:collapse;border-spacing:0;border-color:#ccc;
        }

        .tabel td {
          font-family:Arial;font-size:12px;border-style:solid;padding:5px 5px;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;
        }

        .tabel th {
          font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;
        }

        .tabel .top {
          font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center
        }

        .tabel .bot {
          font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;
        }

        .tengah {
          text-align: center;
        }

        .tebal {
          font-weight: bold;
        }

        @media print {
          .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }

    </style>
    <div>
      @if($jawabansurvey != 'Kosong')
    		<!-- bagian edit-->
    			<div class="header">
    			<div class="title">
    			   <h4 align="center" style="margin-left: 0%;">
               <a style="color: #000; font-size: 16px; font-weight: bold;">Pengolahan Data Hasil Survey Kepuasan Masyarakat Tentang Layanan {{ instansi() }}</a>
             </h4>
    			</div>
          </div>

          <div class="header">
            <div class="title">
                <h4 align="center" style="margin-left: 0%;">
                    <a style="color: #000; font-size: 44px; font-weight: bold;">Total Nilai Akhir IKM</a>
                </h4>
            </div>
          </div>

          @php
          $jumlah_survey_semua = $jawabansurvey->sum('jawaban_poin');
          $total_survey_semua = $jawabansurvey->count();
          $bagi_survey_semua = $jumlah_survey_semua/$total_survey_semua;
          $hasil_semua = $bagi_survey_semua*25;

          if($hasil_semua > 0 && $hasil_semua <= 64.99) {
            $ket_hasil_semua="D (Tidak Baik)" ;
          }

          if($hasil_semua> 65 && $hasil_semua <= 76.60) {
            $ket_hasil_semua="C (Kurang Baik)" ;
          }

          if($hasil_semua> 76.61 && $hasil_semua <= 88.30) {
            $ket_hasil_semua="B (Baik)" ;
          }

          if($hasil_semua> 88.31 && $hasil_semua <= 100) {
            $ket_hasil_semua="A (Sangat Baik)" ;
          }

          @endphp
          <table class="tabel" width="100%" style="margin-top: 20px;">
              <tr>
                <td class="tebal" style="font-size: 25px;">Nilai IKM</td>
                <td class="tebal" style="font-size: 25px;">:</td>
                <td class="tebal" style="font-size: 25px;">{{ round($hasil_semua, 2) }}</td>
            </tr>
            <tr>
                <td class="tebal" style="font-size: 25px;">Mutu</td>
                <td class="tebal" style="font-size: 25px;">:</td>
                <td class="tebal" style="font-size: 25px;">{{ $ket_hasil_semua }}</td>
            </tr>
          </table>


          <div class="panel-body" style="margin-top: 20px;">
            <table class="tabel" width="100%">
              <thead>
                <tr>
                  <th width="10" rowspan="2" class="top">No. Res</th>
                  <th colspan="10" class="top"></th>
                </tr>
                <tr>
                  @foreach ($pertanyaan as $list_pertanyaan)
                    <th width="30" class="top">{{ $list_pertanyaan->pertanyaan_singkatan }}</th>
                  @endforeach
                  <th width="10" class="top"></th>
                </tr>
              </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($responden as $index => $list_responden)
                  <tr>
                      <td class="tengah" width="5">{{ $no++ }}</td>
                      @foreach ($pertanyaan as $list_pertanyaan)
                        @foreach ($jawabansurvey->where('survey_id', $list_responden->survey_id)->where('pertanyaan_id', $list_pertanyaan->pertanyaan_id) as $list_jawaban)
                        <td class="tengah">{{ $list_jawaban->jawaban_poin }}</td>
                        @endforeach
                      @endforeach
                      <td></td>
                  </tr>
                  @endforeach
                  <tr>
                    <td>Nilai Unsur</td>
                    @foreach ($pertanyaan as $list_pertanyaan)
                      <td class="tengah">{{ $jawabansurvey->where('pertanyaan_id', $list_pertanyaan->pertanyaan_id)->sum('jawaban_poin') }}</td>
                    @endforeach
                    <td></td>
                  </tr>
                  <tr>
                    <td>NRR / Unsur</td>
                    @php
                      $total_responden = $responden->count();
                      $total_pertanyaan = $pertanyaan->count();
                    @endphp
                    @foreach ($pertanyaan as $list_pertanyaan)
                      @if($total_responden != 0)
                        <td class="tengah">{{ round($jawabansurvey->where('pertanyaan_id', $list_pertanyaan->pertanyaan_id)->sum('jawaban_poin') / $total_responden, 2) }}</td>
                      @else
                        <td class="tengah">0</td>
                      @endif
                    @endforeach
                    <td></td>
                  </tr>
                  <tr>
                    <td>NRR Tertimbang / Unsur</td>
                    @foreach ($pertanyaan as $list_pertanyaan)
                      @if($total_responden != 0)
                        <td class="tengah">{{ round(($jawabansurvey->where('pertanyaan_id', $list_pertanyaan->pertanyaan_id)->sum('jawaban_poin') / $total_responden) * (1/$total_pertanyaan), 2) }}</td>
                      @else
                        <td class="tengah">0</td>
                      @endif
                    @endforeach
                    @if($total_responden != 0)
                      <td>{{ round(($jawabansurvey->sum('jawaban_poin') / $total_responden) * (1/$total_pertanyaan), 2) }} *</td>
                    @else
                      <td>0</td>
                    @endif

                  </tr>

                  <tr>
                    <td class="tengah" colspan="8">IKM Unit Pelayanan</td>
                    @php
                    $jumlah_survey = $jawabansurvey->sum('jawaban_poin');
                    $total_survey = $jawabansurvey->count();

                    if($jumlah_survey != 0) {
                      $bagi_survey = $jumlah_survey/$total_survey;
                      $hasil = $bagi_survey*25;

                      if($hasil > 0 && $hasil <= 64.99) { $ket_hasil="D (Tidak Baik)" ; } if($hasil> 65 && $hasil <=
                              76.60) { $ket_hasil="C (Kurang Baik)" ; } if($hasil> 76.61 && $hasil <= 88.30) {
                                  $ket_hasil="B (Baik)" ; } if($hasil> 88.31 && $hasil <= 100) {
                                    $ket_hasil="A (Sangat Baik)" ; }
                    } else {
                      $hasil = 0;
                      $ket_hasil = '';
                    }

                    @endphp

                    <td class="tengah tebal" colspan="3"> {{ round($hasil, 2) }} - {{ $ket_hasil }} **</td>
                  </tr>

                </tbody>
            </table>

            <table width="100%" class="tabel" style="margin-top: 20px;">
              <tr>
                  <td class="tengah">No.</td>
                  <td class="tengah">Unsur Pelayanan</td>
                  <td class="tengah">Nilai Rata-Rata</td>
              </tr>
              @foreach ($pertanyaan as $list_pertanyaan)
              <tr>
                  <td>{{ $list_pertanyaan->pertanyaan_singkatan }}</td>
                  <td>{{ $list_pertanyaan->pertanyaan_nama }}</td>
                  @if($total_responden != 0)
                    <td class="tengah">{{ round($jawabansurvey->where('pertanyaan_id', $list_pertanyaan->pertanyaan_id)->sum('jawaban_poin') / $total_responden, 2) }}</td>
                  @else
                    <td class="tengah">0</td>
                  @endif

              </tr>
              @endforeach
            </table>

            <table width="60%" class="tabel" style="margin-top: 20px;" border="1">
              <tr>
                  <td colspan="3">Keterangan : </td>
              </tr>
              <tr>
                <td>{{ $pertanyaan_awal->pertanyaan_singkatan }} s/d {{ $pertanyaan_akhir->pertanyaan_singkatan }}</td>
                <td>=</td>
                <td>Unsur-Unsur Pelayanan</td>
              </tr>
              <tr>
                <td>NRR</td>
                <td>=</td>
                <td>Nilai Rata-Rata</td>
              </tr>
              <tr>
                <td>IKM</td>
                <td>=</td>
                <td>Indeks Kepuasan Masyarakat</td>
              </tr>
              <tr>
                <td>*</td>
                <td>=</td>
                <td>Jumlah NRR IKM Tertimbang</td>
              </tr>
              <tr>
                <td>**</td>
                <td>=</td>
                <td>Jumlah NRR Tertimbang * 25</td>
              </tr>
              <tr>
                <td>NRR Per Unsur</td>
                <td>=</td>
                <td>Jumlah Nilai Per Unsur / Jumlah Kuesioner Yang Terisi</td>
              </tr>
              <tr>
                <td>NRR Tertimbang</td>
                <td>=</td>
                <td>NRR Per Unsur * (1/Jumlah Pertanyaan)</td>
              </tr>
            </table>

            <table class="tabel" width="60%" style="margin-top: 20px;" border="1">
              <tr>
                  <td colspan="2">Mutu Pelayanan : </td>
              </tr>
              <tr>
                <td width="120">A (Sangat Baik)</td>
                <td> : 88,31 - 100,00</td>
              </tr>
              <tr>
                <td>B (Baik)</td>
                <td> : 76,61 - 88,30</td>
              </tr>
              <tr>
                <td>C (Kurang Baik)</td>
                <td> : 65,00 - 76,60</td>
              </tr>
              <tr>
                <td>D (Tidak Baik)</td>
                <td> : 25,00 - 64,99</td>
              </tr>
            </table>

          </div>
      @endif

    </div>
  </body>

  <script>
    window.print();
  </script>

</html>

