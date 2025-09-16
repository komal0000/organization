<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'featured') {
                $query->where('is_featured', true);
            } elseif ($request->status === 'upcoming') {
                $query->upcoming();
            } elseif ($request->status === 'past') {
                $query->past();
            }
        }

        // Order by
        $orderBy = $request->get('order_by', 'event_date');
        $orderDirection = $request->get('order_direction', 'asc');

        if ($orderBy === 'event_date') {
            $query->orderByDate($orderDirection);
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $events = $query->paginate(15);

        return view('back.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_time' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads/events');
        }

        // Set defaults
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);

        Event::create($data);

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('back.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('back.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
           $data['image'] = $request->image->store('uploads/events');
        }

        // Update slug if title changed
        if ($event->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Event::where('slug', $data['slug'])->where('id', '!=', $event->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Set defaults
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        $event->update($data);

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event deleted successfully!');
    }

    /**
     * Toggle event status
     */
    public function toggleStatus(Event $event)
    {
        $event->update([
            'is_active' => !$event->is_active
        ]);

        $status = $event->is_active ? 'activated' : 'deactivated';

        return response()->json([
            'success' => true,
            'message' => "Event {$status} successfully!",
            'status' => $event->is_active
        ]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Event $event)
    {
        $event->update([
            'is_featured' => !$event->is_featured
        ]);

        $status = $event->is_featured ? 'featured' : 'unfeatured';

        return response()->json([
            'success' => true,
            'message' => "Event {$status} successfully!",
            'featured' => $event->is_featured
        ]);
    }

    /**
     * Update event order
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'events' => 'required|array',
            'events.*.id' => 'required|exists:events,id',
            'events.*.order' => 'required|integer'
        ]);

        foreach ($request->events as $eventData) {
            Event::where('id', $eventData['id'])->update(['order' => $eventData['order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event order updated successfully!'
        ]);
    }
}
