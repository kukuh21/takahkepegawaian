<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Folder;
use App\Model\Berkas;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $folder = Folder::count();
        $berkas = Berkas::count();
        return view('dashboard', compact('folder','berkas'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request, $id)
    {
        $db = User::find($id);
        $db->nama = $request->nama;
        $db->email = $request->email;
        $db->username = $request->username;
        $db->password = bcrypt($request->password);
        $db->update();

        session()->flash('success', 'Profile Berhasil Diupdate');
        return redirect()->route('dashboard');
    }
}
