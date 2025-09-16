<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'full_description',
        'location',
        'event_date',
        'event_time',
        'is_active',
        'is_featured',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    protected $dates = [
        'event_date'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);

                // Ensure unique slug
                $originalSlug = $event->slug;
                $counter = 1;
                while (static::where('slug', $event->slug)->exists()) {
                    $event->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }

            if (empty($event->order)) {
                $event->order = static::max('order') + 1;
            }
        });
    }

    /**
     * Scope to get active events
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get featured events
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->format('Y-m-d'));
    }

    /**
     * Scope to get past events
     */
    public function scopePast($query)
    {
        return $query->where('event_date', '<', now()->format('Y-m-d'));
    }

    /**
     * Scope to order by event date
     */
    public function scopeOrderByDate($query, $direction = 'asc')
    {
        return $query->orderBy('event_date', $direction)->orderBy('event_time', $direction);
    }

    /**
     * Scope to order by order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get route key name for model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get formatted event date
     */
    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('M d, Y');
    }

    /**
     * Get formatted event time
     */
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->event_time)->format('g:i A');
    }

    /**
     * Get formatted date and time
     */
    public function getFormattedDateTimeAttribute()
    {
        return $this->formatted_date . ' at ' . $this->formatted_time;
    }

    /**
     * Check if event is upcoming
     */
    public function getIsUpcomingAttribute()
    {
        return $this->event_date >= now()->format('Y-m-d');
    }

    /**
     * Check if event is today
     */
    public function getIsTodayAttribute()
    {
        return $this->event_date->format('Y-m-d') === now()->format('Y-m-d');
    }

    /**
     * Get days until event
     */
    public function getDaysUntilAttribute()
    {
        if (!$this->is_upcoming) {
            return 0;
        }

        return now()->diffInDays($this->event_date);
    }

    /**
     * Get event status text
     */
    public function getStatusTextAttribute()
    {
        if ($this->is_today) {
            return 'Today';
        } elseif ($this->is_upcoming) {
            $days = $this->days_until;
            if ($days === 1) {
                return 'Tomorrow';
            } elseif ($days <= 7) {
                return "In {$days} days";
            } else {
                return $this->formatted_date;
            }
        } else {
            return 'Past Event';
        }
    }
}
