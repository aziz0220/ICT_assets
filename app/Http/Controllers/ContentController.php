<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'file' => 'nullable|file',
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->body = $request->body;
        if ($request->file('file')) {
            $path = $request->file('file')->store('public/files');
            $content->file_path = $path;
        }
        $content->save();

        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'scheduled_at' => 'nullable|date',
        ]);

        $content->scheduled_at = $request->scheduled_at;
        $content->save();

        return back()->with('success', 'Content scheduled successfully.');

    }
}
