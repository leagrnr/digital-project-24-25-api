<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonReadingCollection;
use App\Http\Resources\LessonReadingResource;
use App\Models\LessonReading;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LessonReadingStoreRequest;
use App\Http\Requests\LessonReadingUpdateRequest;

class LessonReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): LessonReadingCollection
    {
        $lessonReadings = LessonReading::all();

        return new LessonReadingCollection($lessonReadings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonReadingStoreRequest $request): LessonReadingResource
    {
        $lessonReading = LessonReading::create($request->validated());

        return new LessonReadingResource($lessonReading);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LessonReading $lessonReading): LessonReadingResource
    {
        return new LessonReadingResource($lessonReading);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonReadingUpdateRequest $request, LessonReading $lessonReading): LessonReadingResource
    {
        $lessonReading->update($request->validated());

        return new LessonReadingResource($lessonReading);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, LessonReading $lessonReading): Response
    {
        $lessonReading->delete();

        return response()->noContent();
    }
}
