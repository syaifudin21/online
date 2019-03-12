<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function index()
    {
        dd('assis');
    	return view('admin.admin');
    }
}
