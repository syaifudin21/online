<?php

namespace App\Http\Controllers\Android\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
        # code...
    }
    public function store(Request $request)
    {
        return 'true';
    }
}
