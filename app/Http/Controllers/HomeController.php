<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOfficeRequest;
use App\Repositories\StoreRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $officeRepository;

    public function __construct(StoreRepositoryInterface $officeRepository)
    {
        $this->middleware('auth');
        $this->officeRepository = $officeRepository;
    }

    public function index()
    {
        return view('home');
    }

    public function post(ChangeOfficeRequest $request)
    {
        $office = $this->officeRepository->find($request->post('store'));
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
