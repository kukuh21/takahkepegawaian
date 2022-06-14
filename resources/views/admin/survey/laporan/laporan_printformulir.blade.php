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
      border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%;
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
    </style>
    <div>
    		<!-- bagian edit-->
    			<div class="header">
    			<div class="title">
    			   <h4 align="center" style="margin-left: 0%;">
               <img style="width: 80px; margin-left: -14px;" src="{{ asset('images/logo-tabalong.png')  }}"/>
               <br>
               <a style="color: #000; font-size: 16px; font-weight: bold;">PROFIL PEGAWAI</a>
               <br><a style="color: #000; font-size: 16px; font-weight: bold;">PEMERINTAH KABUPATEN TABALONG</a>
               <hr>
             </h4>
    			</div>
          </div>
      <div class="panel-body" style="margin-top: 0px;">
        <table class="tabel">
          <thead>
            <tr>
              <th class="top" colspan="2">BIODATA</th>
            </tr>
          </thead>
            <tbody>
                 <tr>
                  <td class="bot">NIP</td>
                </tr>
            </tbody>
        </table>


      </div>
      <br>
      <script>
        window.onload = function() { window.print(); }
      </script>
  </body>
</html>
