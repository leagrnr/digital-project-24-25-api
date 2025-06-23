<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnecdocteStoreRequest;
use App\Http\Requests\AnecdocteUpdateRequest;
use App\Http\Resources\AnecdocteCollection;
use App\Http\Resources\AnecdocteResource;
use App\Models\Anecdocte;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnecdocteController extends Controller
{
    public function index(Request $request): AnecdocteCollection
    {
        $anecdoctes = Anecdocte::all();

        return new AnecdocteCollection($anecdoctes);
    }

    public function store(AnecdocteStoreRequest $request): AnecdocteResource
    {
        $anecdocte = Anecdocte::create($request->validated());

        return new AnecdocteResource($anecdocte);
    }

    public function show(Request $request, Anecdocte $anecdocte): AnecdocteResource
    {
        return new AnecdocteResource($anecdocte);
    }

    public function update(AnecdocteUpdateRequest $request, Anecdocte $anecdocte): AnecdocteResource
    {
        $anecdocte->update($request->validated());

        return new AnecdocteResource($anecdocte);
    }

    public function destroy(Request $request, Anecdocte $anecdocte): Response
    {
        $anecdocte->delete();

        return response()->noContent();
    }

    public function random(Request $request)
{
    $anecdote = Anecdocte::inRandomOrder()->first();

    if (!$anecdote) {
        return response()->json(['message' => 'Aucune anecdote trouvée'], 404);
    }

    return new AnecdocteResource($anecdote);
}
}
