<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index(Request $request)
    {
        $query = Event::active();

        // Filter by type
        $type = $request->get('type', 'upcoming');
        if ($type === 'upcoming') {
            $query->upcoming();
        } elseif ($type === 'past') {
            $query->past();
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Get featured events for upcoming type
        $featuredEvents = collect();
        if ($type === 'upcoming') {
            $featuredEvents = Event::active()
                ->featured()
                ->upcoming()
                ->orderByDate()
                ->take(3)
                ->get();
        }

        // Get all events
        $events = $query->orderByDate($type === 'past' ? 'desc' : 'asc')
                       ->paginate(12);

        return view('front.events.index', compact('events', 'featuredEvents', 'type'));
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        // Check if event is active
        if (!$event->is_active) {
            abort(404);
        }

        // Get related events (upcoming events in same location or similar)
        $relatedEvents = Event::active()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->where(function ($query) use ($event) {
                $query->where('location', 'like', '%' . explode(',', $event->location)[0] . '%')
                      ->orWhere('title', 'like', '%' . explode(' ', $event->title)[0] . '%');
            })
            ->orderByDate()
            ->take(3)
            ->get();

        // If no related events found, get latest upcoming events
        if ($relatedEvents->count() < 3) {
            $relatedEvents = Event::active()
                ->upcoming()
                ->where('id', '!=', $event->id)
                ->orderByDate()
                ->take(3)
                ->get();
        }

        return view('front.events.show', compact('event', 'relatedEvents'));
    }

    /**
     * Get featured events for homepage or other sections
     */
    public function featured()
    {
        $events = Event::active()
            ->featured()
            ->upcoming()
            ->orderByDate()
            ->take(6)
            ->get();

        return response()->json($events);
    }

    /**
     * Get upcoming events API
     */
    public function upcoming()
    {
        $events = Event::active()
            ->upcoming()
            ->orderByDate()
            ->take(10)
            ->get();

        return response()->json($events);
    }

    /**
     * Search events
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2'
        ]);

        $events = Event::active()
            ->where(function ($query) use ($request) {
                $search = $request->q;
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%")
                      ->orWhere('full_description', 'like', "%{$search}%");
            })
            ->orderByDate()
            ->paginate(10);

        return view('front.events.search', compact('events'));
    }
}
