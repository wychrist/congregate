<?php

namespace Modules\CongregateBackend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateUi\Services\MenuService;
use Modules\CongregateUi\Services\MenuItem;

class CongregateBackendController extends BackendBaseController
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->addBreadcrumb("Dashboard", "", true);
        return view('congregatebackend::index');
    }

    public function setting()
    {
        $this->addBreadcrumb("Settings", "", true);
        return view('congregatebackend::setting');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('congregatebackend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('congregatebackend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('congregatebackend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
