<?php

namespace App\Http\Controllers;

use App\Models\FooterLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FooterLinkController extends Controller
{
    /**
     * Display a listing of footer links
     */
    public function index()
    {
        $links = FooterLink::ordered()->get();
        return view('back.footer-links.index', compact('links'));
    }

    /**
     * Show the form for creating a new footer link
     */
    public function create()
    {
        return view('back.footer-links.add');
    }

    /**
     * Store a newly created footer link
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        FooterLink::create($request->all());
        $this->generateFooterLinksCache();

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link added successfully!');
    }

    /**
     * Show the form for editing a footer link
     */
    public function edit($id)
    {
        $link = FooterLink::findOrFail($id);
        return view('back.footer-links.edit', compact('link'));
    }

    /**
     * Update the specified footer link
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $link = FooterLink::findOrFail($id);
        $link->update($request->all());
        $this->generateFooterLinksCache();

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link updated successfully!');
    }

    /**
     * Remove the specified footer link
     */
    public function destroy($id)
    {
        $link = FooterLink::findOrFail($id);
        $link->delete();
        $this->generateFooterLinksCache();

        return redirect()->route('admin.footer-links.index')
            ->with('success', 'Footer link deleted successfully!');
    }

    /**
     * Generate footer links cache
     */
    public function generateFooterLinksCache()
    {
        $links = FooterLink::getActiveOrdered();

        $cacheContent = '<div class="footer-links">' . "\n";
        foreach ($links as $link) {
            $cacheContent .= '    <a class="link" href="' . e($link->url) . '">' . e($link->title) . '</a>' . "\n";
        }
        $cacheContent .= '</div>';

        $cachePath = resource_path('views/front/cache');
        if (!File::exists($cachePath)) {
            File::makeDirectory($cachePath, 0755, true);
        }

        File::put($cachePath . '/footer-links.blade.php', $cacheContent);

        // Also update Laravel cache
        Cache::forget('footer_links');
        Cache::put('footer_links', $links, now()->addHours(24));
    }
}
