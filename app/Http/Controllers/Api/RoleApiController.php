<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Http\Controllers\RespositoryControllers\RoleRepositoryController;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleApiController extends RoleRepositoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function(){
            return RoleService::all($this->roleRepo);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
