<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Http\Request;
use App\Http\Requests\AppUserStoreRequest;
use App\Http\Requests\AppUserUpdateRequest;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AppUser::all();
        return compact(['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppUserStoreRequest $request)
    {
        $entity = AppUser::create($request->validated());
        return compact(['entity']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AppUser $entity)
    {
        return compact(['entity']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppUserUpdateRequest $request, AppUser $entity)
    {
        $entity->update($request->validated());
        return compact(['entity']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppUser $entity)
    {
        $entity->delete();
        return compact(['entity']);
    }
}
