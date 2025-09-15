<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status Update</title>
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
            @if($application->status == 'approved')
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            @elseif($application->status == 'rejected')
                background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            @else
                background: linear-gradient(135deg, #f4891f 0%, #faac19 100%);
            @endif
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

        .status-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            @if($application->status == 'approved')
                background-color: #28a745;
            @elseif($application->status == 'rejected')
                background-color: #dc3545;
            @else
                background-color: #ffc107;
                color: #212529;
            @endif
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
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

        .message-section {
            background-color: #fff3e0;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #f4891f;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registration Status Update</h1>
            <p>Your application status has been updated</p>
        </div>

        <div class="content">
            <p>Dear Applicant,</p>

            <p>We are writing to inform you about an update to your registration application for <strong>{{ $form->title }}</strong>.</p>

            <div class="status-section">
                <h3 style="margin-top: 0; color: #333;">Current Status</h3>
                <div class="status-badge">{{ ucfirst($application->status) }}</div>

                @if($application->status == 'approved')
                    <p style="margin-top: 15px; color: #28a745; font-weight: bold;">
                        Congratulations! Your application has been approved.
                    </p>
                @elseif($application->status == 'rejected')
                    <p style="margin-top: 15px; color: #dc3545; font-weight: bold;">
                        Unfortunately, your application was not approved at this time.
                    </p>
                @endif
            </div>

            <div class="message-section">
                <h4 style="margin-top: 0; color: #f4891f;">Application Details:</h4>
                <div class="info-item">
                    <label>Registration ID:</label>
                    <p><strong>#{{ $application->id }}</strong></p>
                </div>
                <div class="info-item">
                    <label>Form:</label>
                    <p>{{ $form->title }} ({{ $form->year }})</p>
                </div>
                <div class="info-item">
                    <label>Updated:</label>
                    <p>{{ now()->format('F j, Y \a\t g:i A') }}</p>
                </div>

                @if($application->admin_notes)
                <div class="info-item">
                    <label>Additional Notes:</label>
                    <p>{{ $application->admin_notes }}</p>
                </div>
                @endif
            </div>

            @if($application->status == 'approved')
                <div class="message-section" style="background-color: #d4edda; border-left-color: #28a745;">
                    <h4 style="margin-top: 0; color: #28a745;">What's Next?</h4>
                    <p>You will receive further instructions and welcome information from our team shortly. If you have any questions, please don't hesitate to contact us.</p>
                </div>
            @elseif($application->status == 'rejected')
                <div class="message-section" style="background-color: #f8d7da; border-left-color: #dc3545;">
                    <h4 style="margin-top: 0; color: #dc3545;">Next Steps</h4>
                    <p>You may reapply in the future if circumstances change. For specific feedback or questions about your application, please contact our support team.</p>
                </div>
            @endif

            <div class="footer">
                <p>This is an automated notification email. Please do not reply directly to this email.</p>
                <p>If you have questions, please contact us through our official channels.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
