@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.events.index') }}">Events</a> / {{ $event->title }}
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Events
        </a>
        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit Event
        </a>
        <a href="{{ route('events.show', $event->slug) }}" class="btn btn-info" target="_blank">
            <i class="fas fa-external-link-alt me-2"></i>View Public Page
        </a>
        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-2"></i>Delete Event
            </button>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <!-- Main Event Content -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-calendar-alt me-2"></i>{{ $event->title }}
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge {{ $event->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $event->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            @if($event->is_featured)
                                <span class="badge bg-warning">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            @endif
                            <span class="badge {{ $event->is_upcoming ? 'bg-info' : 'bg-secondary' }}">
                                {{ $event->status_text }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="admin-card-body">
                    @if($event->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $event->image) }}"
                                 alt="{{ $event->title }}"
                                 class="img-fluid rounded"
                                 style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6><i class="fas fa-calendar me-2 text-primary"></i>Event Date & Time</h6>
                            <p class="mb-0">
                                <strong>{{ $event->formatted_date }}</strong> at <strong>{{ $event->formatted_time }}</strong>
                            </p>
                            @if($event->is_upcoming)
                                <small class="text-muted">
                                    @if($event->is_today)
                                        Event is today!
                                    @else
                                        {{ $event->days_until }} days from now
                                    @endif
                                </small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-map-marker-alt me-2 text-primary"></i>Location</h6>
                            <p class="mb-0">{{ $event->location }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6><i class="fas fa-align-left me-2 text-primary"></i>Short Description</h6>
                        <p class="text-muted">{{ $event->short_description }}</p>
                    </div>

                    <div class="mb-4">
                        <h6><i class="fas fa-file-alt me-2 text-primary"></i>Full Description</h6>
                        <div class="event-description">
                            {!! $event->full_description !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            @if($event->meta_title || $event->meta_description || $event->meta_keywords)
                <div class="admin-card">
                    <div class="admin-card-header">
                        <i class="fas fa-search me-2"></i>SEO Information
                    </div>
                    <div class="admin-card-body">
                        @if($event->meta_title)
                            <div class="mb-3">
                                <h6>Meta Title</h6>
                                <p class="text-muted mb-0">{{ $event->meta_title }}</p>
                            </div>
                        @endif

                        @if($event->meta_description)
                            <div class="mb-3">
                                <h6>Meta Description</h6>
                                <p class="text-muted mb-0">{{ $event->meta_description }}</p>
                            </div>
                        @endif

                        @if($event->meta_keywords)
                            <div class="mb-3">
                                <h6>Meta Keywords</h6>
                                <p class="text-muted mb-0">{{ $event->meta_keywords }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="admin-card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary toggle-status" data-event-id="{{ $event->id }}">
                            <i class="fas fa-{{ $event->is_active ? 'eye-slash' : 'eye' }} me-2"></i>
                            {{ $event->is_active ? 'Make Inactive' : 'Make Active' }}
                        </button>

                        <button class="btn btn-outline-warning toggle-featured" data-event-id="{{ $event->id }}">
                            <i class="fas fa-star me-2"></i>
                            {{ $event->is_featured ? 'Remove from Featured' : 'Make Featured' }}
                        </button>

                        <a href="{{ route('admin.events.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Create Similar Event
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Statistics -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-chart-line me-2"></i>Event Details
                </div>
                <div class="admin-card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-primary mb-1">{{ $event->order }}</h4>
                                <small class="text-muted">Display Order</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-info mb-1">{{ $event->slug }}</h4>
                                <small class="text-muted">URL Slug</small>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <strong>Created:</strong>
                        <br>
                        <small class="text-muted">{{ $event->created_at->format('M d, Y \a\t g:i A') }}</small>
                    </div>

                    <div class="mb-3">
                        <strong>Last Updated:</strong>
                        <br>
                        <small class="text-muted">{{ $event->updated_at->format('M d, Y \a\t g:i A') }}</small>
                    </div>

                    @if($event->updated_at != $event->created_at)
                        <div class="mb-3">
                            <strong>Last Modified:</strong>
                            <br>
                            <small class="text-muted">{{ $event->updated_at->diffForHumans() }}</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Event Preview -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-eye me-2"></i>Public Preview
                </div>
                <div class="admin-card-body">
                    <div class="border rounded p-3" style="background: #f8f9fa;">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}"
                                 alt="{{ $event->title }}"
                                 class="img-fluid rounded mb-3"
                                 style="height: 120px; width: 100%; object-fit: cover;">
                        @endif

                        <h6 class="mb-2">{{ Str::limit($event->title, 40) }}</h6>
                        <p class="small text-muted mb-2">{{ Str::limit($event->short_description, 80) }}</p>

                        <div class="small">
                            <i class="fas fa-calendar me-1"></i>{{ $event->formatted_date }}
                            <br>
                            <i class="fas fa-clock me-1"></i>{{ $event->formatted_time }}
                            <br>
                            <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($event->location, 25) }}
                        </div>

                        <div class="mt-2">
                            @if($event->is_featured)
                                <span class="badge bg-warning badge-sm">Featured</span>
                            @endif
                            <span class="badge {{ $event->is_upcoming ? 'bg-success' : 'bg-secondary' }} badge-sm">
                                {{ $event->status_text }}
                            </span>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">This is how your event appears to visitors</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Toggle Status
            $('.toggle-status').click(function() {
                const eventId = $(this).data('event-id');
                const button = $(this);

                $.ajax({
                    url: `/admin/events/${eventId}/toggle-status`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Reload page to update all status indicators
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Error updating status. Please try again.');
                    }
                });
            });

            // Toggle Featured
            $('.toggle-featured').click(function() {
                const eventId = $(this).data('event-id');
                const button = $(this);

                $.ajax({
                    url: `/admin/events/${eventId}/toggle-featured`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Reload page to update all featured indicators
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Error updating featured status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection

@section('css')
    <style>
        .event-description {
            font-size: 1rem;
            line-height: 1.6;
        }

        .event-description h1,
        .event-description h2,
        .event-description h3,
        .event-description h4,
        .event-description h5,
        .event-description h6 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .event-description p {
            margin-bottom: 1rem;
        }

        .event-description ul,
        .event-description ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .badge-sm {
            font-size: 0.7rem;
        }
    </style>
@endsection
