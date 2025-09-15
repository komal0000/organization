<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipContent;
use Illuminate\Http\Request;

class MembershipContentController extends Controller
{
    public function index()
    {
        $contents = MembershipContent::orderBy('order')->get();
        return view('back.membership.content.index', compact('contents'));
    }

    public function create()
    {
        return view('back.membership.content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_key' => 'required|unique:membership_contents,section_key',
            'section_name' => 'required|string|max:255',
            'content_type' => 'required|in:text,textarea,rich_text,image',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        MembershipContent::create($request->all());

        return redirect()->route('admin.membership-content.index')
                        ->with('message', 'Content section created successfully!');
    }

    public function edit(MembershipContent $membershipContent)
    {
        return view('back.membership.content.edit', compact('membershipContent'));
    }

    public function update(Request $request, MembershipContent $membershipContent)
    {
        $request->validate([
            'section_key' => 'required|unique:membership_contents,section_key,' . $membershipContent->id,
            'section_name' => 'required|string|max:255',
            'content_type' => 'required|in:text,textarea,rich_text,image',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $membershipContent->update($request->all());

        return redirect()->route('admin.membership-content.index')
                        ->with('message', 'Content section updated successfully!');
    }

    public function destroy(MembershipContent $membershipContent)
    {
        $membershipContent->delete();

        return redirect()->route('admin.membership-content.index')
                        ->with('message', 'Content section deleted successfully!');
    }
}
