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
                                <th style="padding: 15px; font-weight: 500;">Project Name</th>
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
                                    <td style="padding: 12px;">{{ $startup->project_name ?? '-' }}</td>
                                    <td style="padding: 12px;">{{ $startup->year_of_operation }}</td>
                                    <td style="padding: 12px;">{{ $startup->size_of_company }}</td>
                                    <td style="padding: 12px;">{{ $startup->location_of_firm }}</td>
                                    <td style="padding: 12px;">{{ $startup->gender_of_entrepreneurs }}</td>
                                    <td style="padding: 12px;">{{ $startup->sector ?? '-' }}</td>
                                    <td style="padding: 12px;">{{ $startup->status_of_firm }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 30px;">
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
    .jumbotron.modern {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        padding: 60px 20px;
        margin-bottom: 30px;
        border-radius: 0;
    }

    .jumbotron.modern h1 {
        color: white;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .jumbotron.modern p {
        color: white;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .jumbotron.modern a {
        color: white;
        text-decoration: none;
    }

    .jumbotron.modern a.active {
        font-weight: 600;
    }

    .modern-content-section {
        padding: 40px 0;
    }

    .modern-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 30px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin: 0 -20px;
        padding: 0 20px;
    }

    .table-bordered {
        border: 1px solid #faac19 !important;
        min-width: 1000px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ffe0b2 !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table thead th {
        border-bottom: 2px solid #f4891f !important;
        position: sticky;
        top: 0;
        background-color: #f4891f;
        z-index: 10;
    }

    /* Mobile Responsiveness */
    @media (max-width: 992px) {
        .jumbotron.modern h1 {
            font-size: 2rem;
        }

        .jumbotron.modern p {
            font-size: 1rem;
        }

        .modern-card {
            padding: 15px;
        }

        .table-responsive {
            margin: 0 -15px;
            padding: 0 15px;
        }
    }

    @media (max-width: 768px) {
        .jumbotron.modern {
            padding: 40px 15px;
        }

        .jumbotron.modern h1 {
            font-size: 1.75rem;
        }

        .jumbotron.modern p {
            font-size: 0.95rem;
        }

        .modern-content-section {
            padding: 20px 0;
        }

        .modern-card {
            padding: 10px;
            border-radius: 4px;
        }

        .table {
            font-size: 13px;
        }

        .table th,
        .table td {
            padding: 8px 6px !important;
        }

        .table thead th {
            font-size: 12px;
        }

        .table-responsive {
            margin: 0 -10px;
            padding: 0 10px;
        }
    }

    @media (max-width: 576px) {
        .jumbotron.modern h1 {
            font-size: 1.5rem;
        }

        .jumbotron.modern p {
            font-size: 0.9rem;
        }

        .table {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 6px 4px !important;
        }

        .table thead th {
            font-size: 11px;
            padding: 10px 4px !important;
        }
    }

    /* Improve scrollbar visibility */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #faac19;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #f4891f;
    }
</style>
@endsection
