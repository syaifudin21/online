<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:guru');
    }
    public function index()
    {
    	return view('admin.admin');
    }
}
