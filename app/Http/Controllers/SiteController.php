<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Retorna view inicial 
     */
    public function index()
    {
        return view('site.home.index');
    }
}
