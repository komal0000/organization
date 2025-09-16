@extends('front.layout')
@section('meta')
    @includeIf('front.cache.home.meta')
@endsection
@section('content')
    <div class="jumbotron modern">
        <div class="text-center">
            <h1>CSIC Registration</h1>
            <p>Join the Catalyst Startup Idea Competition </p>
        </div>
    </div>

    <div class="modern-content-section">
        <!-- Essential Files Section -->
        @if ($essentialFiles->isNotEmpty())
            <div class="container">
                <div class="modern-card">
                    <h3 class="text-center mb-4">
                        <i class="fas fa-file-download me-2 text-primary"></i>Essential Files
                    </h3>
                    <p class="text-center text-muted mb-5">Download important documents and guidelines for CSIC</p>

                    <div class="row">
                        @foreach ($essentialFiles as $file)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="file-card">
                                    <div class="file-card-body">
                                        <div class="file-icon mb-3">
                                            <i class="{{ $file->file_icon }} fa-2x"></i>
                                        </div>
                                        <h5 class="file-title">{{ $file->title }}</h5>
                                        <div class="file-meta mb-3">
                                            <small class="text-muted">
                                                {{ strtoupper($file->file_type) }} • {{ $file->formatted_file_size }}
                                            </small>
                                        </div>
                                        <a href="{{ $file->download_url }}" class="btn btn-modern-outline btn-sm w-100">
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <div class="modern-card text-center">
                <h3>Ready to Join CSIC?</h3>
                <p class="modern-text-muted mb-4">Take Part In Our Annual Competition</p>
                <a href="{{ route('registration') }}" class="btn btn-modern-primary btn-lg">Register for CSIC</a>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .file-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .file-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .file-card-body {
            padding: 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .file-icon {
            color: #f4891f;
        }

        .file-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.3;
        }

        .file-meta {
            margin-top: auto;
        }

        .btn-modern-outline {
            background: transparent;
            border: 2px solid #f4891f;
            color: #f4891f;
            font-weight: 600;
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .btn-modern-outline:hover {
            background: #f4891f;
            color: white;
            transform: translateY(-1px);
        }
    </style>
@endsection
