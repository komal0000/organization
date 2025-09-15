@extends('front.layout')

@section('head-title')
    <title>Application Submitted | {{ config('app.name') }}</title>
@endsection

@section('css')
<style>
    .success-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        text-align: center;
        padding: 60px 20px;
    }

    .success-card {
        background: white;
        color: #333;
        padding: 60px 40px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: #faac19;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: checkmark 0.6s ease-in-out;
    }

    .success-icon i {
        font-size: 2.5rem;
        color: white;
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

    .success-card h1 {
        color: #333;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .success-card p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #f4891f;
        color: white;
    }

    .btn-primary:hover {
        background: #faac19;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(244, 137, 31, 0.4);
    }

    .btn-outline {
        background: transparent;
        color: #f4891f;
        border: 2px solid #f4891f;
    }

    .btn-outline:hover {
        background: #f4891f;
        color: white;
        transform: translateY(-2px);
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 30px;
        margin-top: 40px;
        text-align: left;
    }

    .info-box h4 {
        color: #333;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .info-box ul {
        margin: 0;
        padding-left: 20px;
        color: #666;
    }

    .info-box li {
        margin-bottom: 8px;
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 40px 20px;
        }

        .success-card h1 {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="success-container">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h1>Application Submitted!</h1>
            <p>Thank you for your interest in becoming a member. Your application has been successfully submitted and is now under review. We will contact you soon with updates on your membership status.</p>

            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="{{ route('membership.index') }}" class="btn btn-outline">
                    <i class="fas fa-users"></i> Learn More About Membership
                </a>
            </div>

            <div class="info-box">
                <h4>What happens next?</h4>
                <ul>
                    <li>Our team will review your application within 3-5 business days</li>
                    <li>You will receive an email confirmation with your application status</li>
                    <li>If approved, you'll receive welcome information and next steps</li>
                    <li>You may be contacted for additional information if needed</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
