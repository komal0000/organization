@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.events.index') }}">Events</a> / Edit Event
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Events
        </a>
        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-info">
            <i class="fas fa-eye me-2"></i>View Event
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-edit me-2"></i>Edit Event: {{ $event->title }}
                </div>
                <div class="admin-card-body">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" id="eventForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-heading me-1"></i>Event Title *
                                </label>
                                <input type="text" name="title" class="form-control admin-form-control"
                                       value="{{ old('title', $event->title) }}" required>
                                @error('title')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-image me-1"></i>Event Image
                                </label>
                                <input type="file" name="image" class="form-control admin-form-control"
                                       accept="image/*" id="imageInput">
                                @error('image')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror

                                @if($event->image)
                                    <div class="mt-2" id="currentImage">
                                        <label class="form-label small">Current Image:</label>
                                        <div>
                                            <img src="{{ vasset($event->image) }}"
                                                 alt="{{ $event->title }}"
                                                 class="img-thumbnail"
                                                 style="max-width: 150px;">
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-2" id="imagePreview" style="display: none;">
                                    <label class="form-label small">New Image Preview:</label>
                                    <div>
                                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Short Description *
                            </label>
                            <textarea name="short_description" class="form-control admin-form-control"
                                      rows="3" maxlength="500" required>{{ old('short_description', $event->short_description) }}</textarea>
                            <small class="form-text text-muted">Maximum 500 characters</small>
                            @error('short_description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-file-alt me-1"></i>Full Description *
                            </label>
                            <textarea name="full_description" class="form-control admin-form-control"
                                      id="fullDescription" rows="8" required>{{ old('full_description', $event->full_description) }}</textarea>
                            @error('full_description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Location *
                                </label>
                                <input type="text" name="location" class="form-control admin-form-control"
                                       value="{{ old('location', $event->location) }}" required
                                       placeholder="e.g., New York Expo Center, NY">
                                @error('location')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-calendar me-1"></i>Event Date *
                                </label>
                                <input type="date" name="event_date" class="form-control admin-form-control"
                                       value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                                @error('event_date')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-clock me-1"></i>Event Time *
                                </label>
                                <input type="time" name="event_time" class="form-control admin-form-control"
                                       value="{{ old('event_time', $event->event_time->format('H:i')) }}" required>
                                @error('event_time')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Update Event
                            </button>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary ms-2">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Event Settings -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-cog me-2"></i>Event Settings
                </div>
                <div class="admin-card-body">
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input"
                               id="isActive" {{ old('is_active', $event->is_active) ? 'checked' : '' }} form="eventForm">
                        <label class="form-check-label" for="isActive">
                            <strong>Active Event</strong>
                            <br><small class="text-muted">Event will be visible to public</small>
                        </label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input"
                               id="isFeatured" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }} form="eventForm">
                        <label class="form-check-label" for="isFeatured">
                            <strong>Featured Event</strong>
                            <br><small class="text-muted">Event will appear in featured sections</small>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Event Info -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-info-circle me-2"></i>Event Information
                </div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Status:</strong>
                            <br>
                            <span class="badge {{ $event->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $event->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <strong>Featured:</strong>
                            <br>
                            <span class="badge {{ $event->is_featured ? 'bg-warning' : 'bg-light text-dark' }}">
                                {{ $event->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <strong>Created:</strong>
                            <br>
                            <small>{{ $event->created_at->format('M d, Y') }}</small>
                        </div>
                        <div class="col-6">
                            <strong>Updated:</strong>
                            <br>
                            <small>{{ $event->updated_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <strong>Event Status:</strong>
                        <br>
                        <span class="badge {{ $event->is_upcoming ? 'bg-info' : 'bg-secondary' }}">
                            {{ $event->status_text }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-search me-2"></i>SEO Settings
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label class="admin-form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control admin-form-control"
                               value="{{ old('meta_title', $event->meta_title) }}" maxlength="255" form="eventForm"
                               placeholder="Leave empty to use event title">
                        <small class="form-text text-muted">Recommended: 50-60 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="admin-form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control admin-form-control"
                                  rows="3" maxlength="500" form="eventForm"
                                  placeholder="Leave empty to use short description">{{ old('meta_description', $event->meta_description) }}</textarea>
                        <small class="form-text text-muted">Recommended: 150-160 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="admin-form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control admin-form-control"
                               value="{{ old('meta_keywords', $event->meta_keywords) }}" form="eventForm"
                               placeholder="event, workshop, conference">
                        <small class="form-text text-muted">Separate keywords with commas</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {

            // Image preview
            $('#imageInput').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#imagePreview').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });

            // Character counter for short description
            $('textarea[name="short_description"]').on('input', function() {
                const maxLength = 500;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                // Update or create counter
                let counter = $(this).siblings('.char-counter');
                if (counter.length === 0) {
                    counter = $('<small class="form-text text-muted char-counter"></small>');
                    $(this).after(counter);
                }

                counter.text(`${currentLength}/${maxLength} characters`);

                if (remaining < 50) {
                    counter.removeClass('text-muted').addClass('text-warning');
                }
                if (remaining < 0) {
                    counter.removeClass('text-warning').addClass('text-danger');
                }
                if (remaining >= 50) {
                    counter.removeClass('text-warning text-danger').addClass('text-muted');
                }
            });

            // Trigger character counter on load
            $('textarea[name="short_description"]').trigger('input');

            // Form ID for cross-card form elements
            $('form').attr('id', 'eventForm');
        });
    </script>
@endsection
