<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Repositories\OfficeRepositoryInterface;
use App\Utils\UtilsKey;
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
            UtilsKey::CURRENT_STORE_ID => $office->id,
            UtilsKey::CURRENT_STORE_NAME => $office->name,
        ]);

        return redirect()->route('home');
    }

    public function remove(Request $request)
    {
        $request->session()->forget([
            UtilsKey::CURRENT_STORE_ID, UtilsKey::CURRENT_STORE_NAME
        ]);

        return redirect()->route('home');
    }
}
