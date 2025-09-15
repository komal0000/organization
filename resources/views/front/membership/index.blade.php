@extends('front.layout')

@section('head-title')
    <title>Become a Member | {{ config('app.name') }}</title>
@endsection

@section('css')
<style>
    .membership-hero {
        background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .membership-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .membership-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .membership-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .membership-form-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        margin: -50px auto 80px;
        max-width: 800px;
        position: relative;
        z-index: 2;
        overflow: hidden;
    }

    .form-progress {
        display: flex;
        background: #f8f9fa;
        padding: 0;
        margin: 0;
        border-bottom: 1px solid #e9ecef;
    }

    .progress-step {
        flex: 1;
        padding: 20px;
        text-align: center;
        border-right: 1px solid #e9ecef;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .progress-step:last-child {
        border-right: none;
    }

    .progress-step.active {
        background: #f4891f;
        color: white;
    }

    .progress-step.completed {
        background: #faac19;
        color: white;
    }

    .progress-step h6 {
        margin: 0;
        font-weight: 600;
    }

    .progress-step small {
        opacity: 0.8;
    }

    .form-section {
        display: none;
        padding: 40px;
        animation: fadeIn 0.3s ease;
    }

    .form-section.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e8e8e8;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus {
        outline: none;
        border-color: #f4891f;
        box-shadow: 0 0 0 3px rgba(244, 137, 31, 0.1);
    }

    .form-control:hover {
        border-color: #c4c4c4;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 8px;
    }

    .radio-option {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .radio-option input[type="radio"] {
        margin-right: 8px;
        transform: scale(1.2);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        padding: 20px 40px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
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

    .btn-secondary {
        background: #e8e8e8;
        color: #333;
    }

    .btn-secondary:hover {
        background: #d4d4d4;
    }

    .btn-success {
        background: #faac19;
        color: white;
    }

    .btn-success:hover {
        background: #f4891f;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(250, 172, 25, 0.4);
    }

    .select-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 45px;
    }

    .content-section {
        margin: 60px 0;
        padding: 40px 0;
    }

    .content-section h2 {
        color: #333;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .benefit-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .benefit-card:hover {
        transform: translateY(-5px);
    }

    .benefit-card i {
        font-size: 3rem;
        color: #f4891f;
        margin-bottom: 20px;
    }

    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-error {
        background: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    .alert-success {
        background: #efe;
        color: #393;
        border: 1px solid #cfc;
    }

    @media (max-width: 768px) {
        .membership-hero h1 {
            font-size: 2.5rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .radio-group {
            flex-direction: column;
            gap: 10px;
        }

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="membership-hero">
    <div class="container">
        <h1>{{ App\Models\MembershipContent::getContent('hero_title') ?: 'Become a Member' }}</h1>
        <p>{{ App\Models\MembershipContent::getContent('hero_subtitle') ?: 'Join our community and unlock exclusive benefits, networking opportunities, and resources to grow your career and business.' }}</p>
    </div>
</section>

<!-- Benefits Section -->
<section class="content-section">
    <div class="container">
        <h2>{{ App\Models\MembershipContent::getContent('benefits_title') ?: 'Membership Benefits' }}</h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <i class="fas fa-users"></i>
                <h4>Networking Opportunities</h4>
                <p>Connect with like-minded professionals and expand your network through exclusive events and meetups.</p>
            </div>
            <div class="benefit-card">
                <i class="fas fa-graduation-cap"></i>
                <h4>Professional Development</h4>
                <p>Access to workshops, seminars, and training programs to enhance your skills and knowledge.</p>
            </div>
            <div class="benefit-card">
                <i class="fas fa-handshake"></i>
                <h4>Business Opportunities</h4>
                <p>Discover new business partnerships, collaborations, and growth opportunities within our community.</p>
            </div>
        </div>
    </div>
</section>

<!-- Membership Form -->
<div class="container">
    <div class="membership-form-container">
        <!-- Progress Indicator -->
        <div class="form-progress">
            <div class="progress-step active" data-step="1">
                <h6>Your Details</h6>
                <small>Personal Information</small>
            </div>
            <div class="progress-step" data-step="2">
                <h6>Additional Information</h6>
                <small>Background & Preferences</small>
            </div>
            <div class="progress-step" data-step="3">
                <h6>About Company</h6>
                <small>Organization Details</small>
            </div>
        </div>

        <form id="membershipForm" method="POST" action="{{ route('membership.store') }}">
            @csrf

            <!-- Step 1: Your Details -->
            <div class="form-section active" data-step="1">
                <h3>Your Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number *</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="residential_area">Residential Area</label>
                    <textarea class="form-control" id="residential_area" name="residential_area" rows="3"></textarea>
                </div>
            </div>

            <!-- Step 2: Additional Information -->
            <div class="form-section" data-step="2">
                <h3>Additional Information</h3>

                <div class="form-group">
                    <label for="chapter_applying_for">Which Chapter are you applying for?</label>
                    <select class="form-control select-control" id="chapter_applying_for" name="chapter_applying_for">
                        <option value="">----</option>
                        <option value="kathmandu">Kathmandu</option>
                        <option value="pokhara">Pokhara</option>
                        <option value="chitwan">Chitwan</option>
                        <option value="dharan">Dharan</option>
                        <option value="butwal">Butwal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Are You A Nepali Citizen?</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="nepali_yes" name="nepali_citizen" value="yes">
                            <label for="nepali_yes">Yes</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="nepali_no" name="nepali_citizen" value="no">
                            <label for="nepali_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="academic_qualification">Academic Qualification</label>
                    <textarea class="form-control" id="academic_qualification" name="academic_qualification" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    <select class="form-control select-control" id="marital_status" name="marital_status">
                        <option value="">Select Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="organization_member">Are you a member of any other organization? If yes, please specify here.</label>
                    <textarea class="form-control" id="organization_member" name="organization_member" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="sector">Sector</label>
                    <select class="form-control select-control" id="sector" name="sector">
                        <option value="">Sector</option>
                        <option value="Accommodation/Hospitality">Accommodation/Hospitality</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Arts, Entertainment, and Recreation">Arts, Entertainment, and Recreation</option>
                        <option value="Biotechnology">Biotechnology</option>
                        <option value="Business and Personal Support">Business and Personal Support</option>
                        <option value="Communication / Media">Communication / Media</option>
                        <option value="Consulting">Consulting</option>
                        <option value="Defense Industries">Defense Industries</option>
                        <option value="Educational Services">Educational Services</option>
                        <option value="Financial Services">Financial Services</option>
                        <option value="Fishing and Hunting">Fishing and Hunting</option>
                        <option value="Food Services and Drinking Establishment">Food Services and Drinking Establishment</option>
                        <option value="Forestry">Forestry</option>
                        <option value="Handicraft">Handicraft</option>
                        <option value="Health Care and Social Assistance">Health Care and Social Assistance</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Insurance">Insurance</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Mining, Quarrying, and Oil and Gas Extraction">Mining, Quarrying, and Oil and Gas Extraction</option>
                        <option value="Other Services (except Public Administration)">Other Services (except Public Administration)</option>
                        <option value="Professional, Scientific, and Technical Services">Professional, Scientific, and Technical Services</option>
                        <option value="Public Administration">Public Administration</option>
                        <option value="Real Estate and Rental and Leasing">Real Estate and Rental and Leasing</option>
                        <option value="Retail Trade">Retail Trade</option>
                        <option value="Transportation and Warehousing">Transportation and Warehousing</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Wholesale Trade">Wholesale Trade</option>
                    </select>
                </div>
            </div>

            <!-- Step 3: About Company -->
            <div class="form-section" data-step="3">
                <h3>About Company</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" class="form-control" id="website" name="website" placeholder="https://example.com">
                    </div>
                    <div class="form-group">
                        <label for="number_of_employees">Number Of Employees</label>
                        <input type="number" class="form-control" id="number_of_employees" name="number_of_employees" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="organization_telephone">Organization Telephone</label>
                        <input type="tel" class="form-control" id="organization_telephone" name="organization_telephone">
                    </div>
                    <div class="form-group">
                        <label for="organization_email">Organization Email</label>
                        <input type="email" class="form-control" id="organization_email" name="organization_email">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                    <i class="fas fa-arrow-left"></i> Previous
                </button>
                <button type="button" class="btn btn-primary" id="nextBtn">
                    Next <i class="fas fa-arrow-right"></i>
                </button>
                <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                    <i class="fas fa-check"></i> Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Additional Content Sections -->
<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h2>{{ App\Models\MembershipContent::getContent('additional_info_title') ?: 'Ready to Join?' }}</h2>
                <p>{{ App\Models\MembershipContent::getContent('additional_info_content') ?: 'Take the first step towards growing your network and advancing your career. Fill out the membership application above and become part of our thriving community.' }}</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
let currentStep = 1;
const totalSteps = 3;

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    updateFormDisplay();
});

// Next button click
document.getElementById('nextBtn').addEventListener('click', function() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            updateFormDisplay();
        }
    }
});

// Previous button click
document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentStep > 1) {
        currentStep--;
        updateFormDisplay();
    }
});

// Progress step click
document.querySelectorAll('.progress-step').forEach(step => {
    step.addEventListener('click', function() {
        const stepNumber = parseInt(this.dataset.step);
        if (stepNumber < currentStep || validateStepsUpTo(stepNumber - 1)) {
            currentStep = stepNumber;
            updateFormDisplay();
        }
    });
});

function updateFormDisplay() {
    // Update form sections
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    document.querySelector(`.form-section[data-step="${currentStep}"]`).classList.add('active');

    // Update progress steps
    document.querySelectorAll('.progress-step').forEach(step => {
        const stepNumber = parseInt(step.dataset.step);
        step.classList.remove('active', 'completed');

        if (stepNumber === currentStep) {
            step.classList.add('active');
        } else if (stepNumber < currentStep) {
            step.classList.add('completed');
        }
    });

    // Update buttons
    document.getElementById('prevBtn').style.display = currentStep > 1 ? 'block' : 'none';
    document.getElementById('nextBtn').style.display = currentStep < totalSteps ? 'block' : 'none';
    document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'block' : 'none';
}

function validateCurrentStep() {
    const currentSection = document.querySelector(`.form-section[data-step="${currentStep}"]`);
    const requiredFields = currentSection.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.style.borderColor = '#e74c3c';
            isValid = false;
        } else {
            field.style.borderColor = '#e8e8e8';
        }
    });

    if (!isValid) {
        alert('Please fill in all required fields before proceeding.');
    }

    return isValid;
}

function validateStepsUpTo(stepNumber) {
    for (let i = 1; i <= stepNumber; i++) {
        const section = document.querySelector(`.form-section[data-step="${i}"]`);
        const requiredFields = section.querySelectorAll('[required]');

        for (let field of requiredFields) {
            if (!field.value.trim()) {
                return false;
            }
        }
    }
    return true;
}

// Form submission
document.getElementById('membershipForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!validateCurrentStep()) {
        return;
    }

    const formData = new FormData(this);
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    submitBtn.disabled = true;

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "{{ route('membership.success') }}";
        } else {
            alert(data.message || 'There was an error submitting your application. Please try again.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your application. Please try again.');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});
</script>
@endsection
