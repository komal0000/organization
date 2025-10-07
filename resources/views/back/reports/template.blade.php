@if ($reports->count() > 0)
<div class="reports-documents-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Reports & Documents</h2>
                    <div class="title-underline"></div>
                    <p class="section-subtitle">Access our organizational reports, publications, and important documents</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($reports as $report)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="report-card">
                    {{-- <div class="report-icon">
                        <i class="fas fa-file-{{ strtolower($report->file_extension) }}"></i>
                    </div> --}}
                    <div class="report-content">
                        <h5 class="report-title">{{ $report->title }}</h5>
                        @if($report->description)
                            <p class="report-description">{{ $report->description }}</p>
                        @endif
                        <div class="report-meta">
                            <span class="file-type">{{ strtoupper($report->file_extension) }}</span>
                            {{-- <span class="file-size">{{ $report->file_size }}</span> --}}
                        </div>
                    </div>
                    <div class="report-actions">
                        <a href="{{ asset($report->document) }}" target="_blank" class="btn btn-download">
                            <i class="fas fa-download me-2"></i>Download
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.reports-documents-section {
    padding: 80px 0;
    background: #f8f9fa;
    position: relative;
}

.section-header {
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--org-primary, #2c3e50);
    margin-bottom: 1rem;
    letter-spacing: 1px;
}

.title-underline {
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
    margin: 0 auto 1.5rem;
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.report-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #e9ecef;
    position: relative;
    overflow: hidden;
}

.report-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.report-icon {
    text-align: center;
    margin-bottom: 20px;
}

.report-icon i {
    font-size: 3rem;
    color: var(--org-primary, #2c3e50);
    opacity: 0.8;
    transition: all 0.3s ease;
}

.report-card:hover .report-icon i {
    color: var(--org-base, #27ae60);
    transform: scale(1.1);
}

.report-content {
    flex-grow: 1;
    text-align: center;
    margin-bottom: 20px;
}

.report-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    line-height: 1.4;
}

.report-description {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.report-meta {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 15px;
}

.file-type, .file-size {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.file-type {
    background: var(--org-primary, #2c3e50);
    color: white;
}

.report-actions {
    text-align: center;
}

.btn-download {
    background: linear-gradient(135deg, var(--org-primary, #2c3e50) 0%, var(--org-base, #27ae60) 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
    border: none;
}

.btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    color: white;
    text-decoration: none;
}

/* File type specific icon colors */
.report-card .fa-file-pdf {
    color: #dc3545;
}

.report-card .fa-file-word {
    color: #2b579a;
}

.report-card .fa-file-alt {
    color: #17a2b8;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .reports-documents-section {
        padding: 60px 0;
    }

    .section-title {
        font-size: 2rem;
    }

    .report-card {
        padding: 25px;
    }

    .report-icon i {
        font-size: 2.5rem;
    }

    .report-title {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .section-title {
        font-size: 1.8rem;
    }

    .report-meta {
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .btn-download {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}
</style>
@endif
