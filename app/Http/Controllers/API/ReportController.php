<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

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


}
