<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EssentialFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EssentialFileController extends Controller
{
    /**
     * Display a listing of essential files
     */
    public function index()
    {
        $files = EssentialFile::ordered()->paginate(15);
        return view('back.essential-files.index', compact('files'));
    }

    /**
     * Show the form for creating a new essential file
     */
    public function create()
    {
        return view('back.essential-files.create');
    }

    /**
     * Store a newly created essential file
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', // 10MB max
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->only(['title', 'order']);
        $data['is_active'] = $request->has('is_active');

        // Handle document upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $data['document'] = $file->storeAs('uploads/essential-files', $fileName);
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }

        EssentialFile::create($data);

        return redirect()->route('admin.essential-files.index')
                        ->with('message', 'Essential file created successfully!');
    }

    /**
     * Display the specified essential file
     */
    public function show(EssentialFile $essentialFile)
    {
        return view('back.essential-files.show', compact('essentialFile'));
    }

    /**
     * Show the form for editing the specified essential file
     */
    public function edit(EssentialFile $essentialFile)
    {
        return view('back.essential-files.edit', compact('essentialFile'));
    }

    /**
     * Update the specified essential file
     */
    public function update(Request $request, EssentialFile $essentialFile)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240',
            'order' => 'required|integer|min:0'
        ]);

        $data = $request->only(['title', 'order']);
        $data['is_active'] = $request->has('is_active');

        // Handle document upload
        if ($request->hasFile('document')) {
            // Delete old file
            if ($essentialFile->document && Storage::exists($essentialFile->document)) {
                Storage::delete($essentialFile->document);
            }

            $file = $request->file('document');
            $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $data['document'] = $file->storeAs('uploads/essential-files', $fileName);
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }

        $essentialFile->update($data);

        return redirect()->route('admin.essential-files.index')
                        ->with('message', 'Essential file updated successfully!');
    }

    /**
     * Remove the specified essential file
     */
    public function destroy(EssentialFile $essentialFile)
    {
        $essentialFile->delete();

        return redirect()->route('admin.essential-files.index')
                        ->with('message', 'Essential file deleted successfully!');
    }

    /**
     * Toggle file status (active/inactive)
     */
    public function toggleStatus(EssentialFile $essentialFile)
    {
        $essentialFile->update(['is_active' => !$essentialFile->is_active]);

        $status = $essentialFile->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.essential-files.index')
                        ->with('message', "Essential file {$status} successfully!");
    }

    /**
     * Download file
     */
    public function download($id)
    {
        $file = EssentialFile::findOrFail($id);

        if (!$file->document || !Storage::exists($file->document)) {
            abort(404, 'File not found');
        }

        return Storage::download($file->document, $file->title . '.' . $file->file_type);
    }
}
