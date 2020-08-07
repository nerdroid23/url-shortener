<?php

namespace App\Http\Controllers\Api;

use App\Url;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreUrlRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class UrlController
{
    public function index(): JsonResponse
    {
        return response()->json(
            auth()->user()->urls()->paginate(3)
        );
    }

    public function store(StoreUrlRequest $request): JsonResponse
    {
        return response()->json(
            auth()->user()->urls()->create($request->validated()),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @param \App\Url $url
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function show(Url $url)
    {
        if (request()->wantsJson()) {
            return response()->json(
                $url->only(['original_url', 'shortened_url', 'visits', 'created_at']),
            );
        }

        $url->increment('visits');
        return Response::redirectTo($url->original_url);
    }

    public function destroy(Url $url): JsonResponse
    {
        $url->delete();
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
