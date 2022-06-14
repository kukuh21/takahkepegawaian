<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Berkas;
use App\Model\Folder;
use DataTables;
use JsValidator;
use Alert;
use File;

class BerkasController extends Controller
{
    public function fileberkas($id)
    {
        $data = Folder::findOrFail($id);
        return view('berkas.berkas_index', [
            'data' => $data,
            'JsValidator' => JsValidator::make($this->rulesBerkas()),
            'JsValidatorEdit' => JsValidator::make($this->rulesEdit())

        ]);
    }

    public function rulesBerkas()
    {
      return [
          'nama_berkas' => 'required',
          'file' => 'required'
      ];
    }

    public function rulesEdit()
    {
      return [
          'nama_berkas' => 'required'
      ];
    }

    public function data($id)
    {
        $model = Berkas::query()->where('folder_id', $id)->orderBy('berkas_nama','asc');
        return Datatables::of($model)
            ->addColumn('file', function ($query) {
                if($query->berkas_file != null) {
                  return '
                    <div align="center">
                      <a target="_blank" href="'.asset('berkas/'.$query->folder_id.'/'.$query->berkas_file).'"  class="m-0.7 btn btn-icon btn-success btn-sm text-white w-30">
                        <i class="fa fa-check"></i>
                      </a>
                    </div>
                  ';
                } else {
                  return '
                    <div align="center">
                      <a href="#"  class="m-0.7 btn btn-icon btn-danger btn-sm text-white w-30">
                        <i class="fa fa-close"></i>
                      </a>
                    </div>
                  ';
                }
            })
            ->addColumn('action', function ($query) {
                return '
                <div align="center">
                <a onclick="edit('.$query->berkas_id.')"  class="m-0.7 btn btn-icon btn-warning btn-sm text-white w-30">
                  <i class="fa fa-edit"></i>
                </a>
                <a onclick="rename('.$query->berkas_id.')"  class="m-0.7 btn btn-icon btn-info btn-sm text-white w-30">
                  <i class="fa fa-feather"></i>
                </a>
                <a href="' . route('berkas.destroy', $query->berkas_id) . '" id="hapus' . $query->berkas_id . '" class="m-0.7 btn btn-icon btn-danger btn-sm w-30">
                 <i class="fa fa-trash"></i>
                </a>
                <form action="' . route('berkas.destroy', $query->berkas_id) . '" method="post" id="form-target' . $query->berkas_id . '">
                ' . method_field("DELETE") . '
                ' . csrf_field() . '
                </form>
                </div>
                <script>
                  $( "a#hapus' . $query->berkas_id . '" ).click(function( event ) {
                    event.preventDefault();
                    swal({
                      title: "Apakah Anda Yakin",
                      text: "Ingin menghapus data ini",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Ya, Hapus",
                      closeOnConfirm: false,
                      customClass: "Custom_Cancel"
                    },
                    function(){
                       $("form#form-target' . $query->berkas_id . '").submit();
                    });
                  });
                </script>
                ';
            })
            ->addIndexColumn('berkas_id')
            ->toJson();
    }

    public function storeJson(Request $request)
    {
        $data = $this->validate($request, $this->rulesBerkas());
        $cek = Berkas::where('berkas_nama', $request->nama_berkas)->where('folder_id', $request->folder_id)->first();
        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Berkas;
          $db->berkas_nama = $request->nama_berkas;
          $db->folder_id = $request->folder_id;

          if ($request->hasFile('file')) {
              $file = 'Berkas-'. uniqid() . '.' . $request->file->getClientOriginalExtension();
              $destination = "berkas/".$request->folder_id;
              $filename = $request->file('file');
              $filename->move($destination, $file);
              $db->berkas_file = $file;
          }

          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function editJson($id)
    {
        $db = Berkas::findOrFail($id);
        echo json_encode($db);
    }

    public function updateJson(Request $request, $id)
    {
        $data = $this->validate($request, $this->rulesBerkas());
        $cek = Berkas::where('berkas_nama', $request->nama_berkas)->where('folder_id', $request->folder_id)->first();

        if($cek != NULL && $cek->berkas_id != $id) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = Berkas::findOrFail($id);
          $db->berkas_nama = $request->nama_berkas;
          $db->folder_id = $request->folder_id;

          if ($request->hasFile('file')) {

              if($db->berkas_file != null) {
                  File::delete('berkas/'.$db->folder_id.'/'.$db->berkas_file);
              }

              $file = 'Berkas-'. uniqid() . '.' . $request->file->getClientOriginalExtension();
              $destination = "berkas/".$request->folder_id;
              $filename = $request->file('file');
              $filename->move($destination, $file);
              $db->berkas_file = $file;
          }

          if ($db->update()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Diupdate'], 200);
          }
        }
    }

    public function updateNamaJson(Request $request, $id)
    {
        $data = $this->validate($request, $this->rulesEdit());
        $cek = Berkas::where('berkas_nama', $request->nama_berkas)->where('folder_id', $request->folder_id)->first();

        if($cek != NULL && $cek->berkas_id != $id) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = Berkas::findOrFail($id);
          $db->berkas_nama = $request->nama_berkas;

          if ($db->update()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Diupdate'], 200);
          }
        }
    }

    public function destroy($id)
    {
        $db = Berkas::findOrFail($id);
        $folder = Folder::find($db->folder_id);

        if($db->berkas_file != null) {
          File::delete('berkas/'.$db->folder_id.'/'.$db->berkas_file);
        }
        $db->delete();

        return redirect()->route('fileberkas', $folder);
    }
}
