<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Repositories\OfficeRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $officeRepository;

    public function __construct(OfficeRepositoryInterface $officeRepository)
    {
        $this->middleware('auth');
        $this->officeRepository = $officeRepository;
    }

    public function index()
    {
        return view('home');
    }

    public function post(Request $request)
    {
        $officeId = $request->post('office');
        $office = $this->officeRepository->find($officeId);

        if (!$office) {
            return redirect()->route('logout');
        }

        session([
            'current_branch' => $office->id,
            'current_branch_name' => $office->name,
        ]);

        return redirect()->route('home');
    }


    public function remove(Request $request)
    {
        $request->session()->forget([
            'current_branch', 'current_branch_name'
        ]);

        return redirect()->route('home');
    }
}
