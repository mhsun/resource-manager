<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\SnippetRequest;
use App\Models\Snippet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SnippetController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return $this->respondWithSuccess(
                "Data fetched successfully", Snippet::latest()->get()
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to fetch data", $exception->getMessage()
            );
        }
    }

    /**
     * @param SnippetRequest $request
     *
     * @return JsonResponse
     */
    public function store(SnippetRequest $request): JsonResponse
    {
        try {
            return $this->respondWithSuccess(
                "Snippet added successfully", Snippet::create($request->validated()), Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to add snippet", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return $this->respondWithSuccess(
                "Data fetched successfully", Snippet::findOrFail($id)
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to fetch data", $exception->getMessage(), Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * @param SnippetRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(SnippetRequest $request, int $id): JsonResponse
    {
        try {
            $snippet = Snippet::findOrFail($id);

            $snippet->update($request->validated());

            return $this->respondWithSuccess(
                "Snippet updated successfully", $snippet->fresh()
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to update snippet", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $snippet = Snippet::findOrFail($id);

            $snippet->delete();

            return $this->respondWithSuccess(
                "Snippet deleted successfully", [], Response::HTTP_NO_CONTENT
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to delete snippet", $exception->getMessage(), Response::HTTP_NOT_FOUND
            );
        }
    }
}
