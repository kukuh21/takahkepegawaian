<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Folder;
use App\Model\Berkas;
use DataTables;
use JsValidator;
use Alert;

class FolderController extends Controller
{
    public function index()
    {
        return view('folder.folder_index', [
            'JsValidator' => JsValidator::make($this->rulesCreate()),
        ]);
    }

    public function rulesCreate()
    {
      return [
          'nama_folder' => 'required'
      ];
    }

    public function data()
    {
        $model = Folder::query()->orderBy('folder_nama','asc');
        return Datatables::of($model)
            ->addColumn('action', function ($query) {
                return '
                <div align="center">
                <a onclick="edit('.$query->folder_id.')"  class="m-0.7 btn btn-icon btn-warning btn-sm text-white w-30">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="'. route('fileberkas', $query->folder_id) .'"  class="m-0.7 btn btn-icon btn-success btn-sm text-white w-30">
                  <i class="fa fa-folder"></i>
                </a>
                <a href="' . route('folder.destroy', $query->folder_id) . '" id="hapus' . $query->folder_id . '" class="m-0.7 btn btn-icon btn-danger btn-sm w-30">
                 <i class="fa fa-trash"></i>
                </a>
                <form action="' . route('folder.destroy', $query->folder_id) . '" method="post" id="form-target' . $query->folder_id . '">
                ' . method_field("DELETE") . '
                ' . csrf_field() . '
                </form>
                </div>
                <script>
                  $( "a#hapus' . $query->folder_id . '" ).click(function( event ) {
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
                       $("form#form-target' . $query->folder_id . '").submit();
                    });
                  });
                </script>
                ';
            })
            ->addIndexColumn('folder_id')
            ->toJson();
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rulesCreate());
        $cek = Folder::where('folder_nama', $request->nama_folder)->first();
        if($cek != null) {
          return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
        } else {
          $db = new Folder;
          $db->folder_nama = $request->nama_folder;
          if ($db->save()) {
            return response()->json(['code'=>200, 'status' => 'Data Berhasil Disimpan'], 200);
          }
        }
    }

    public function editJson($id)
    {
        $db = Folder::findOrFail($id);
        echo json_encode($db);
    }

    public function update(Request $request, $id)
    {
      $data = $this->validate($request, $this->rulesCreate());
      $cek = Folder::where('folder_nama', $request->nama_folder)->first();

      if($cek != NULL && $cek->folder_id != $id) {
        return response()->json(['code'=>400, 'status' => 'Maaf Data Ini Sudah Ada'], 200);
      } else {
        $db = Folder::findOrFail($id);
        $db->folder_nama = $request->nama_folder;
        if ($db->update()) {
          return response()->json(['code'=>200, 'status' => 'Data Berhasil Diupdate'], 200);
        }
      }
    }

    public function destroy($id)
    {
        $cek = Berkas::where('folder_id', $id);

        if($cek) {
          session()->flash('error', 'Ada Berkas Pada Folder Ini');
          return redirect()->route('folder.index');
        } else {
          Folder::destroy($id);
          return redirect()->route('folder.index');
        }
    }
}
