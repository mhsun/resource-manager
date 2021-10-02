<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use App\Models\Link;
use App\Models\Snippet;
use Illuminate\Support\Facades\Response;

class VisitorController extends Controller
{
    public function attachments()
    {
        return view('visitor.attachment', [
            'attachments' => AttachmentResource::collection(Attachment::latest()->get())
        ]);
    }

    public function downloadAttachment(Attachment $attachment)
    {
        return Response::download($attachment->formattedPath);
    }

    public function snippets()
    {
        return view('visitor.snippet', [
            'snippets' => Snippet::latest()->get()
        ]);
    }

    public function links()
    {
        return view('visitor.links', [
            'links' => Link::latest()->get()
        ]);
    }
}
