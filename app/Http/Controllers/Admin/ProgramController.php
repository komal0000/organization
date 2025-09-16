<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs
     */
    public function index()
    {
        $programs = Program::orderBy('order', 'asc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);

        return view('back.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program
     */
    public function create()
    {
        return view('back.programs.create');
    }

    /**
     * Store a newly created program
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:programs,title',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'order' => 'required|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                                               ->store('uploads/programs');
        }

        // Handle gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('uploads/programs/gallery');
            }
            $data['gallery_images'] = $galleryImages;
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')
                        ->with('message', 'Program created successfully!');
    }

    /**
     * Display the specified program
     */
    public function show(Program $program)
    {
        return view('back.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified program
     */
    public function edit(Program $program)
    {
        return view('back.programs.edit', compact('program'));
    }

    /**
     * Update the specified program
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:programs,title,' . $program->id,
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order' => 'required|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('uploads/programs');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('uploads/programs/gallery');
            }
            $data['gallery_images'] = $galleryImages;
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')
                        ->with('message', 'Program updated successfully!');
    }

    /**
     * Remove the specified program
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
                        ->with('message', 'Program deleted successfully!');
    }

    /**
     * Toggle program status (active/inactive)
     */
    public function toggleStatus(Program $program)
    {
        $program->update(['is_active' => !$program->is_active]);

        $status = $program->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.programs.index')
                        ->with('message', "Program {$status} successfully!");
    }

    /**
     * Update program order
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'programs' => 'required|array',
            'programs.*.id' => 'required|exists:programs,id',
            'programs.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->programs as $programData) {
            Program::where('id', $programData['id'])
                   ->update(['order' => $programData['order']]);
        }

        return response()->json(['message' => 'Program order updated successfully!']);
    }
}
