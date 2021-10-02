<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use App\Models\Link;
use App\Models\Snippet;

class ManagementController extends Controller
{
    public function attachments()
    {
        return view('administrator.attachment', [
            'attachments' => AttachmentResource::collection(Attachment::latest()->get())
        ]);
    }

    public function snippets()
    {
        return view('administrator.snippet', [
            'snippets' => Snippet::latest()->paginate()
        ]);
    }

    public function links()
    {
        return view('administrator.links');
    }
}
