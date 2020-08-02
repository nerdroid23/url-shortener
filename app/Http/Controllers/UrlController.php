<?php

namespace App\Http\Controllers;

use App\Url;
use App\Http\Requests\StoreUrlRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\{JsonResponse, Response as ResponseCode};

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
            ResponseCode::HTTP_CREATED
        );
    }

    public function destroy(Url $url): JsonResponse
    {
        $url->delete();
        return Response::json(null, ResponseCode::HTTP_NO_CONTENT);
    }

    /*public function show(Url $url): Response
    {
        //
    }

    public function update(StoreUrlRequest $request, Url $url): JsonResponse
    {
        //
    }*/
}
