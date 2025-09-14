@extends('front.layout')

@section('title', ' - Form Submitted Successfully')

@section('css')
<style>
/* Google Forms Success Style */
.success-container {
    max-width: 760px;
    margin: 40px auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
    padding: 60px 40px;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: #34a853;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    animation: checkmark 0.6s ease-in-out;
}

.success-icon i {
    color: white;
    font-size: 40px;
}

.success-title {
    font-size: 24px;
    font-weight: 400;
    color: #202124;
    margin-bottom: 16px;
}

.success-message {
    font-size: 16px;
    color: #5f6368;
    margin-bottom: 40px;
    line-height: 1.5;
}

.success-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary {
    background: #1a73e8;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background: #1557b0;
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: #f1f3f4;
    color: #3c4043;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.2s;
}

.btn-secondary:hover {
    background: #e8eaed;
    color: #3c4043;
    text-decoration: none;
}

@keyframes checkmark {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .success-container {
        margin: 20px 16px;
        padding: 40px 24px;
    }

    .success-actions {
        flex-direction: column;
        align-items: center;
    }

    .btn-primary,
    .btn-secondary {
        width: 100%;
        max-width: 200px;
    }
}
</style>
@endsection

@section('content')
<div class="success-container">
    <div class="success-icon">
        <i class="fas fa-check"></i>
    </div>

    <h1 class="success-title">Your response has been recorded</h1>

    <p class="success-message">
        Thank you for your submission! We have received your registration form and will review it shortly.
        You should receive a confirmation email at the provided email address.
    </p>

    <div class="success-actions">
        <a href="{{ route('registration') }}" class="btn-secondary">
            <i class="fas fa-plus me-2"></i>Submit another response
        </a>
        <a href="{{ route('home') }}" class="btn-primary">
            <i class="fas fa-home me-2"></i>Go to Homepage
        </a>
    </div>
</div>
@endsection
