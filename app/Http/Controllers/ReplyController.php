<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyStoreRequest;
use App\Http\Requests\ReplyUpdateRequest;
use App\Http\Resources\ReplyCollection;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    public function index(Request $request): ReplyCollection
    {
        $replies = Reply::all();

        return new ReplyCollection($replies);
    }

    public function store(ReplyStoreRequest $request): ReplyResource
    {
        $reply = Reply::create($request->validated());

        return new ReplyResource($reply);
    }

    public function show(Request $request, Reply $reply): ReplyResource
    {
        return new ReplyResource($reply);
    }

    public function update(ReplyUpdateRequest $request, Reply $reply): ReplyResource
    {
        $reply->update($request->validated());

        return new ReplyResource($reply);
    }

    public function destroy(Request $request, Reply $reply): Response
    {
        $reply->delete();

        return response()->noContent();
    }
}
