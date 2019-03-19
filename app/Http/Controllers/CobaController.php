<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index()
    {
      return view('coba.imageUpload');
    }

    public function uploadImage(Request $request)
    {
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        $path = public_path('images/'.$image_name);

        file_put_contents($path, $image);

        return response()->json(['status'=>true]);
    }
}
