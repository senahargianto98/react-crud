<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;
use App\Events\Artikel;

class GoodController extends Controller
{

    public function Paginate()
    {
        $guest = Good::orderBy('id','DESC')->paginate('6');
        return $guest;
    } 
    
    public function GetAll()
    {
        $guest = Good::all();
        return $guest;
    }

    public function Store(Request $request)
    {
        $guest = new Good;
        $guest->judul = $request->input('judul');
        $guest->artikel = $request->input('artikel');
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $filer = $file;
                $filer != "";
                $ext = $filer->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                $file->move(base_path() . '/public/profiles', $fileName);
                $guest->gambar = '/profiles/' . $fileName;
            }
        }
        $guest->save();
        $guest1 = $request->input('judul');
        $guest2 = $request->input('artikel');
        $guest3 = $guest->gambar;
        $guest4 = $guest->id;
        event(new Artikel($guest1,$guest2,$guest3,$guest4));
        return response($guest);
    }

    public function Detail($id)
    {
        $guest = Good::where('id', $id)->first();
        return $guest;
    }


    public function Update(Request $request)
    {
        $id = $request->input('id');
        $guest = Good::find($id);
        $guest->judul = $request->input('judul');
        $guest->artikel = $request->input('artikel');
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $filer = $file;
                $filer != "";
                $ext = $filer->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                $file->move(base_path() . '/public/profiles', $fileName);
                $guest->gambar = '/profiles/' . $fileName;
                $guest->save();
            }
        }
        $guest->save();
        return $guest;
    }

    public function Delete($id)
    {
        $guest = Good::where('id', $id)->delete();
        return $guest;
    }
}
