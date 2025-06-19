<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Http\Resources\LessonCollection;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    public function index(Request $request): LessonCollection
    {
        $lessons = Lesson::all();

        return new LessonCollection($lessons);
    }

    public function store(LessonStoreRequest $request): LessonResource
    {
        $lesson = Lesson::create($request->validated());

        return new LessonResource($lesson);
    }

    public function show(Request $request, Lesson $lesson): LessonResource
    {
        return new LessonResource($lesson);
    }

    public function update(LessonUpdateRequest $request, Lesson $lesson): LessonResource
    {
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    public function destroy(Request $request, Lesson $lesson): Response
    {
        $lesson->delete();

        return response()->noContent();
    }

    public function searchByCategory(Request $request): LessonCollection
    {
        $categoryId = $request->query('category_id');

        $lessons = Lesson::where('category_id', $categoryId)->get();

        return new LessonCollection($lessons);
    }

    public function searchByKeyword(Request $request): LessonCollection
    {
        $keyword = $request->query('keyword');

        $lessons = Lesson::where('keywords', 'LIKE', "%$keyword%")->get();

        return new LessonCollection($lessons);
    }
}
