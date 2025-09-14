@extends('back.layout')
@section('head-title')
    <a href="{{                                                             <button type="button" class="btn btn-admin-outline btn-sm"
                                                                onclick="viewResponse({{ $response->id }})" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <a href="{{ route('admin.admin_form_delete_response', [$form->id, $response->id]) }}"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </a>min.admin_form_index') }}">Forms</a>
    <a href="#">Responses</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.admin_form_index') }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Forms
    </a>
    <a href="{{ route('admin.admin_form_edit', $form->id) }}" class="btn btn-admin-primary">
        <i class="fas fa-edit me-2"></i>Edit Form
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-chart-bar me-2"></i>Responses for: {{ $form->title }}
        <span class="badge bg-info ms-2">{{ $responses->count() }} responses</span>
    </div>
    <div class="admin-card-body">
                                @if ($responses->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Submitted At</th>
                                                    <th>IP Address</th>
                                                    @foreach ($form->fields as $field)
                                                        <th>{{ $field->label }}</th>
                                                    @endforeach
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($responses as $response)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $response->created_at->format('M d, Y H:i') }}</td>
                                                        <td>{{ $response->ip_address }}</td>
                                                        @foreach ($form->fields as $field)
                                                            <td>
                                                                @if (isset($response->responses[$field->name]))
                                                                    @if ($field->type == 'file')
                                                                        <a href="{{ asset('storage/' . $response->responses[$field->name]) }}"
                                                                            target="_blank" class="btn btn-sm btn-info">
                                                                            <i class="fas fa-download"></i> Download
                                                                        </a>
                                                                    @elseif($field->type == 'checkbox')
                                                                        @if (is_array($response->responses[$field->name]))
                                                                            {{ implode(', ', $response->responses[$field->name]) }}
                                                                        @else
                                                                            {{ $response->responses[$field->name] }}
                                                                        @endif
                                                                    @else
                                                                        {{ $response->responses[$field->name] }}
                                                                    @endif
                                                                @else
                                                                    <span class="text-muted">-</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                        <td>
                                                            <button class="btn btn-sm btn-info"
                                                                onclick="viewResponse({{ $response->id }})">
                                                                <i class="fas fa-eye"></i> View
                                                            </button>
                                                            <a href="{{ route('admin.admin_form_delete_response', [$form->id, $response->id]) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5>No responses yet</h5>
                                        <p class="text-muted">Share this form to start collecting responses:</p>
                                        <div class="input-group" style="max-width: 500px; margin: 0 auto;">
                                            <input type="text" class="form-control"
                                                value="{{ route('forms.show', $form->slug) }}" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"
                                                    onclick="copyToClipboard('{{ route('forms.show', $form->slug) }}')">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
            </div>
        </div>
    </div>
</div>

    <!-- Response Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Response Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="responseDetails">
                    <!-- Response details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewResponse(responseId) {
            // This would load response details via AJAX
            // For now, just show modal
            $('#responseModal').modal('show');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link copied to clipboard!');
            });
        }
    </script>
@endsection
