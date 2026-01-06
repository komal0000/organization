@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>Startup Database</h1>
            <p>Explore our comprehensive database of registered startups</p>
            <div class="mt-3">
                <a href="{{ route('home') }}">Home</a> /
                <a class="active">Startup Database</a>
            </div>
        </div>
    </div>

    <div class="modern-content-section">
        <div class="container">
            <div class="modern-card">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #f4891f; color: white;">
                                <th style="padding: 15px; font-weight: 500;">S.N</th>
                                <th style="padding: 15px; font-weight: 500;">Name of the Firm</th>
                                <th style="padding: 15px; font-weight: 500;">Year of Operation</th>
                                <th style="padding: 15px; font-weight: 500;">Size of the Company</th>
                                <th style="padding: 15px; font-weight: 500;">Location of Firm</th>
                                <th style="padding: 15px; font-weight: 500;">Gender of Entrepreneurs</th>
                                <th style="padding: 15px; font-weight: 500;">Please Specify the Sector</th>
                                <th style="padding: 15px; font-weight: 500;">Status of Firm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($startups as $index => $startup)
                                <tr style="background-color: {{ $index % 2 == 0 ? '#e1f5fe' : '#f0f9ff' }};">
                                    <td style="padding: 12px;">{{ $index + 1 }}</td>
                                    <td style="padding: 12px;">{{ $startup->name_of_firm }}</td>
                                    <td style="padding: 12px;">{{ $startup->year_of_operation }}</td>
                                    <td style="padding: 12px;">{{ $startup->size_of_company }}</td>
                                    <td style="padding: 12px;">{{ $startup->location_of_firm }}</td>
                                    <td style="padding: 12px;">{{ $startup->gender_of_entrepreneurs }}</td>
                                    <td style="padding: 12px;">{{ $startup->sector ?? '-' }}</td>
                                    <td style="padding: 12px;">{{ $startup->status_of_firm }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 30px;">
                                        <p class="modern-text-muted">No startups found in the database.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style>
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-bordered {
        border: 1px solid #faac19 !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ffe0b2 !important;
        vertical-align: middle;
    }

    .table thead th {
        border-bottom: 2px solid #f4891f !important;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        .table th,
        .table td {
            padding: 8px !important;
        }
    }
</style>
@endsection
