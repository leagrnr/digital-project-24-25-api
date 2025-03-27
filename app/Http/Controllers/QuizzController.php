<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizzStoreRequest;
use App\Http\Requests\QuizzUpdateRequest;
use App\Http\Resources\QuizzCollection;
use App\Http\Resources\QuizzResource;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuizzController extends Controller
{
    public function index(Request $request): QuizzCollection
    {
        $quizzs = Quizz::all();

        return new QuizzCollection($quizzs);
    }

    public function store(QuizzStoreRequest $request): QuizzResource
    {
        $quizz = Quizz::create($request->validated());

        return new QuizzResource($quizz);
    }

    public function show(Request $request, Quizz $quizz): QuizzResource
    {
        return new QuizzResource($quizz);
    }

    public function update(QuizzUpdateRequest $request, Quizz $quizz): QuizzResource
    {
        $quizz->update($request->validated());

        return new QuizzResource($quizz);
    }

    public function destroy(Request $request, Quizz $quizz): Response
    {
        $quizz->delete();

        return response()->noContent();
    }
}
