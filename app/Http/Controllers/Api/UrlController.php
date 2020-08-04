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
        return Response::json(
            Url::query()->orderByDesc('created_at')->get()
        );
    }

    public function store(StoreUrlRequest $request): JsonResponse
    {
        return Response::json(
            Url::create($request->validated()),
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
        if (!Request::ajax()) {
            $url->increment('visits');
            return Response::redirectTo($url->original_url);
        }

        return Response::json(
            $url->only(['original_url', 'shortened_url', 'visits', 'created_at']),
        );
    }

    public function destroy(Url $url): JsonResponse
    {
        $url->delete();
        return Response::json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
