<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin: -20px -20px 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 0 20px;
        }

        .info-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-item label {
            font-weight: bold;
            color: #f4891f;
            display: block;
            margin-bottom: 5px;
        }

        .info-item p {
            margin: 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            background-color: #f4891f;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .contact-info {
            background-color: #fff3e0;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #f4891f;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registration Confirmation</h1>
            <p>Thank you for your registration with {{ config('app.name') }}</p>
        </div>

        <div class="content">
            <p>Dear Applicant,</p>

            <p>We have successfully received your registration for <strong>{{ $form->title }}</strong>. Your application is currently being reviewed by our team.</p>

            <div class="info-section">
                <h3 style="color: #f4891f; margin-top: 0;">Registration Details:</h3>
                <div class="info-item">
                    <label>Registration ID:</label>
                    <p><strong>#{{ $registration->id }}</strong></p>
                </div>
                <div class="info-item">
                    <label>Form:</label>
                    <p>{{ $form->title }} ({{ $form->year }})</p>
                </div>
                <div class="info-item">
                    <label>Submitted Date:</label>
                    <p>{{ $registration->submitted_at->format('F j, Y \a\t g:i A') }}</p>
                </div>
                <div class="info-item">
                    <label>Status:</label>
                    <p><span class="status-badge">{{ ucfirst($registration->status) }}</span></p>
                </div>
            </div>

            @if(count($formData) > 0)
            <div class="info-section">
                <h3 style="color: #f4891f; margin-top: 0;">Submitted Information:</h3>
                @foreach($registration->form->fields as $field)
                    @if(isset($formData[$field->name]) && !empty($formData[$field->name]))
                    <div class="info-item">
                        <label>{{ $field->label }}:</label>
                        <p>
                            @if($field->type === 'file')
                                File uploaded: {{ basename($formData[$field->name]) }}
                            @else
                                {{ $formData[$field->name] }}
                            @endif
                        </p>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif

            <div class="contact-info">
                <h4 style="margin-top: 0; color: #f4891f;">What's Next?</h4>
                <p>Our team will review your registration and contact you within 3-5 business days. If you have any questions or need to update your information, please contact us.</p>
            </div>

            <div class="footer">
                <p>This is an automated confirmation email. Please do not reply directly to this email.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
