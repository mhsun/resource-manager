<?php

namespace App\Http\Controllers;

class ManagementController extends Controller
{
    public function attachments()
    {
        return view('administrator.attachment');
    }

    public function snippets()
    {
        return view('administrator.snippet');
    }

    public function links()
    {
        return view('administrator.links');
    }
}
