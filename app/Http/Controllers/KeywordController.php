<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeywordStoreRequest;
use App\Http\Requests\KeywordUpdateRequest;
use App\Http\Resources\KeywordCollection;
use App\Http\Resources\KeywordResource;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeywordController extends Controller
{
    public function index(Request $request): KeywordCollection
    {
        $keywords = Keyword::all();

        return new KeywordCollection($keywords);
    }

    public function store(KeywordStoreRequest $request): KeywordResource
    {
        $keyword = Keyword::create($request->validated());

        return new KeywordResource($keyword);
    }

    public function show(Request $request, Keyword $keyword): KeywordResource
    {
        return new KeywordResource($keyword);
    }

    public function update(KeywordUpdateRequest $request, Keyword $keyword): KeywordResource
    {
        $keyword->update($request->validated());

        return new KeywordResource($keyword);
    }

    public function destroy(Request $request, Keyword $keyword): Response
    {
        $keyword->delete();

        return response()->noContent();
    }
}
