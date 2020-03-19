<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function modal()
    {
        return view('partials.report.generate');
    }

    public function generate()
    {
        
    }
}
