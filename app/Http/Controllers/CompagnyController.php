<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompagnyStoreRequest;
use App\Http\Requests\CompagnyUpdateRequest;
use App\Http\Resources\CompagnyCollection;
use App\Http\Resources\CompagnyResource;
use App\Models\Compagny;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompagnyController extends Controller
{
    public function index(Request $request): CompagnyCollection
    {
        $compagnies = Compagny::all();

        return new CompagnyCollection($compagnies);
    }

    public function store(CompagnyStoreRequest $request): CompagnyResource
    {
        $compagny = Compagny::create($request->validated());

        return new CompagnyResource($compagny);
    }

    public function show(Request $request, Compagny $compagny): CompagnyResource
    {
        return new CompagnyResource($compagny);
    }

    public function update(CompagnyUpdateRequest $request, Compagny $compagny): CompagnyResource
    {
        $compagny->update($request->validated());

        return new CompagnyResource($compagny);
    }

    public function destroy(Request $request, Compagny $compagny): Response
    {
        $compagny->delete();

        return response()->noContent();
    }
}
