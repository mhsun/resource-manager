<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LinkController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return $this->respondWithSuccess(
                "Data fetched successfully", Link::latest()->get()
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to fetch data", $exception->getMessage()
            );
        }
    }

    /**
     * @param LinkRequest $request
     *
     * @return JsonResponse
     */
    public function store(LinkRequest $request): JsonResponse
    {
        try {
            return $this->respondWithSuccess(
                "Link added successfully",
                Link::create($request->validated()), Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to add link", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param LinkRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(LinkRequest $request, int $id): JsonResponse
    {
        try {
            $link = Link::findOrFail($id);

            $link->update($request->validated());

            return $this->respondWithSuccess(
                "Link updated successfully", $link->fresh()
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to update link", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
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
            $link = Link::findOrFail($id);

            $link->delete();

            return $this->respondWithSuccess(
                "Link deleted successfully", [], Response::HTTP_NO_CONTENT
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to delete link", $exception->getMessage(), Response::HTTP_NOT_FOUND
            );
        }
    }
}
