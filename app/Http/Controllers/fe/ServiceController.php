<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = \DB::connection('portal-itsa')->table('service')->get();
        return view('layouts.front-end.service.service', compact('service'));
    }
}
