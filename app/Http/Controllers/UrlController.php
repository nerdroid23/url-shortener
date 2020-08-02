<?php

namespace App\Http\Controllers;

use App\Url;
use App\Http\Requests\StoreUrlRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

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
            Url::create($request->validated())->only(['original_url', 'shortened_url']),
            JsonResponse::HTTP_CREATED
        );
    }

    public function show(Url $url): JsonResponse
    {
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
