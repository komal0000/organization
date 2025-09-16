@extends('back.layout')

@section('head-title')
    <a href="#">Events Management</a>
@endsection

@section('toolbar')
    <a href="{{ route('admin.events.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add New Event
    </a>
@endsection

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-calendar-alt me-2"></i>Events Management
                    <span class="badge bg-info ms-2">{{ $events->total() }} events</span>
                </div>
                <div class="d-flex gap-2">
                    <!-- Search Form -->
                    <form method="GET" class="d-flex">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="order_by" value="{{ request('order_by') }}">
                        <input type="hidden" name="order_direction" value="{{ request('order_direction') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Search events..."
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="admin-card-body">
            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" class="d-flex gap-2">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">All Events</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="past" {{ request('status') === 'past' ? 'selected' : '' }}>Past</option>
                        </select>
                        <select name="order_by" class="form-select" onchange="this.form.submit()">
                            <option value="event_date" {{ request('order_by', 'event_date') === 'event_date' ? 'selected' : '' }}>Event Date</option>
                            <option value="created_at" {{ request('order_by') === 'created_at' ? 'selected' : '' }}>Created Date</option>
                            <option value="title" {{ request('order_by') === 'title' ? 'selected' : '' }}>Title</option>
                            <option value="order" {{ request('order_by') === 'order' ? 'selected' : '' }}>Order</option>
                        </select>
                        <select name="order_direction" class="form-select" onchange="this.form.submit()">
                            <option value="asc" {{ request('order_direction', 'asc') === 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('order_direction') === 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    @if(request()->hasAny(['search', 'status', 'order_by']))
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Clear Filters
                        </a>
                    @endif
                </div>
            </div>

            @if($events->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="events-table">
                        <thead>
                            <tr>
                                <th width="80">Image</th>
                                <th>Title</th>
                                <th width="150">Event Date</th>
                                <th width="120">Location</th>
                                <th width="100">Status</th>
                                <th width="100">Featured</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-events">
                            @foreach($events as $event)
                                <tr data-event-id="{{ $event->id }}">
                                    <td>
                                        @if($event->image)
                                            <img src="{{ asset($event->image) }}"
                                                 alt="{{ $event->title }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $event->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($event->short_description, 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $event->formatted_date }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $event->formatted_time }}</small>
                                        </div>
                                        <div class="mt-1">
                                            <span class="badge badge-sm {{ $event->is_upcoming ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $event->status_text }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($event->location, 20) }}</small>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm toggle-status {{ $event->is_active ? 'btn-success' : 'btn-secondary' }}"
                                                data-event-id="{{ $event->id }}"
                                                data-status="{{ $event->is_active }}"
                                                title="Toggle Status">
                                            <i class="fas fa-{{ $event->is_active ? 'check' : 'times' }}"></i>
                                            {{ $event->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm toggle-featured {{ $event->is_featured ? 'btn-warning' : 'btn-outline-warning' }}"
                                                data-event-id="{{ $event->id }}"
                                                data-featured="{{ $event->is_featured }}"
                                                title="Toggle Featured">
                                            <i class="fas fa-star"></i>
                                            {{ $event->is_featured ? 'Featured' : 'Normal' }}
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.events.show', $event) }}"
                                               class="btn btn-sm btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.events.edit', $event) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-alt fa-4x text-muted mb-4"></i>
                    <h4>No Events Found</h4>
                    <p class="text-muted">
                        @if(request()->hasAny(['search', 'status']))
                            No events match your current filters.
                        @else
                            Start by creating your first event.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary me-2">
                            Clear Filters
                        </a>
                    @endif
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create Event
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
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
                            if (response.status) {
                                button.removeClass('btn-secondary').addClass('btn-success');
                                button.html('<i class="fas fa-check"></i> Active');
                            } else {
                                button.removeClass('btn-success').addClass('btn-secondary');
                                button.html('<i class="fas fa-times"></i> Inactive');
                            }
                            button.data('status', response.status);
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
                            if (response.featured) {
                                button.removeClass('btn-outline-warning').addClass('btn-warning');
                                button.html('<i class="fas fa-star"></i> Featured');
                            } else {
                                button.removeClass('btn-warning').addClass('btn-outline-warning');
                                button.html('<i class="fas fa-star"></i> Normal');
                            }
                            button.data('featured', response.featured);
                        }
                    },
                    error: function() {
                        alert('Error updating featured status. Please try again.');
                    }
                });
            });

            // Initialize sortable if events exist
            if ($('#sortable-events tr').length > 0) {
                $('#sortable-events').sortable({
                    handle: 'td:first-child',
                    update: function(event, ui) {
                        updateEventOrder();
                    }
                });
            }

            function updateEventOrder() {
                const eventIds = [];
                $('#sortable-events tr').each(function(index) {
                    const eventId = $(this).data('event-id');
                    if (eventId) {
                        eventIds.push({
                            id: eventId,
                            order: index + 1
                        });
                    }
                });

                $.ajax({
                    url: '{{ route("admin.events.update-order") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        events: eventIds
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Order updated successfully');
                        }
                    },
                    error: function() {
                        alert('Error updating order. Please try again.');
                        location.reload();
                    }
                });
            }
        });
    </script>
@endsection
