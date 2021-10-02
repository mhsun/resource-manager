<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AttachmentStoreRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AttachmentController extends ApiController
{
    /**
     * @return JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try {
            return AttachmentResource::collection(Attachment::latest()->get())->additional([
                'message' => 'Data fetched successfully'
            ]);
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to fetch data", $exception->getMessage()
            );
        }
    }

    /**
     * @param AttachmentStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(AttachmentStoreRequest $request)
    {
        try {
            $attachment = new Attachment();
            $attachment->title = $request->get('title');
            $attachment->path = $request->file('file')->store("attachments");
            $attachment->save();

            return $this->respondWithSuccess(
                "Attachment uploaded successfully", new AttachmentResource($attachment), Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to upload attachment", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param AttachmentUpdateRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(AttachmentUpdateRequest $request, int $id)
    {
        try {
            $attachment = Attachment::findOrFail($id);

            $request->uploadIfFileExistAgainst($attachment);

            return $this->respondWithSuccess(
                "Attachment updated successfully", new AttachmentResource($attachment->refresh())
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to update data", $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY
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
            $attachment = Attachment::findOrFail($id);

            $attachment->unlink();

            $attachment->delete();

            return $this->respondWithSuccess(
                "Data deleted successfully", [], Response::HTTP_NO_CONTENT
            );
        } catch (\Exception $exception) {
            return $this->respondWithError(
                "Failed to delete data", $exception->getMessage()
            );
        }
    }
}
