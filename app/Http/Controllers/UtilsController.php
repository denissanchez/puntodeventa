<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;

class UtilsController extends Controller
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $utils = $this->repository->utils();
        return view('util.index')->with($utils);
    }
}
