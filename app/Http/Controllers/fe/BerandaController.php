<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $service = \DB::connection('portal-itsa')->table('service')->get();
        return view('layouts.front-end.beranda.beranda', compact('service'));
    }
}
