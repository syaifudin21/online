<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Image;

class Images extends Model
{
    public function upload($file, $path)
    {
        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostorefoto = env('APP_ENV').'/siswa/ijazah_'.$filename.'_'.uniqid().'.'.$extension;
        // Storage::disk('ftp')->put($filenametostorefoto, fopen($file, 'r+'));
        return $filenametostorefoto;
    }
    public function compress($file, $path)
    {
        $photo = Image::make($file)
        ->resize(400, null, function ($constraint) { $constraint->aspectRatio(); } )
        ->encode('jpg',100);

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostorefoto = env('APP_ENV').'/'.$path.'/'.$filename.'_'.uniqid().'.'.$extension;

        Storage::disk('ftp')->put($filenametostorefoto, $photo);
     
        return $filenametostorefoto;
    }

    public function icon($file, $path)
    {
        $photo = Image::make($file)
        ->resize(80, null, function ($constraint) { $constraint->aspectRatio(); } )
        ->encode('jpg',100);

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostorefoto = env('APP_ENV').'/'.$path.'/'.$filename.'_'.uniqid().'.'.$extension;

        // Storage::disk('ftp')->put($filenametostorefoto, $photo);
     
        return $filenametostorefoto;
    }

}
