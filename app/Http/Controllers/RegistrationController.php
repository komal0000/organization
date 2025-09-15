<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    /**
     * Display the registration form
     */
    public function index()
    {
        $form = Form::where('is_active', true)->first();

        if (!$form) {
            return view('front.registration.unavailable');
        }

        return view('front.registration.index', compact('form'));
    }

    /**
     * Handle registration form submission
     */
    public function store(Request $request)
    {
        $form = Form::where('is_active', true)->with('fields')->first();

        if (!$form) {
            return response()->json([
                'success' => false,
                'message' => 'Registration is currently unavailable.'
            ], 404);
        }

        // Build validation rules dynamically based on form fields
        $rules = $this->buildValidationRules($form);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Please check your input and try again.'
            ], 422);
        }

        try {
            // Process form data
            $formData = $this->processFormData($request, $form);

            // Store registration response
            $registration = FormResponse::create([
                'form_id' => $form->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'responses' => $formData,
                'status' => 'pending',
                'submitted_at' => now()
            ]);

            // Send confirmation email if email field exists
            $this->sendConfirmationEmail($registration, $formData);

            return response()->json([
                'success' => true,
                'message' => 'Registration submitted successfully! You will receive a confirmation email shortly.',
                'registration_id' => $registration->id
            ]);

        } catch (\Exception $e) {
            Log::error('Registration submission error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'There was an error processing your registration. Please try again.'
            ], 500);
        }
    }

    /**
     * Show registration success page
     */
    public function success()
    {
        return view('front.registration.success');
    }

    /**
     * Build validation rules from form fields
     */
    private function buildValidationRules($form)
    {
        $rules = [];

        foreach ($form->fields as $field) {
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            switch ($field->type) {
                case 'email':
                    $fieldRules[] = 'email';
                    $fieldRules[] = 'unique:form_responses,responses->' . $field->name;
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:10240'; // 10MB max
                    break;
                case 'phone':
                    $fieldRules[] = 'regex:/^[+]?[0-9\s\-\(\)]+$/';
                    break;
                case 'text':
                case 'textarea':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'max:1000';
                    break;
                case 'select':
                case 'radio':
                    if (!empty($field->options)) {
                        $options = is_array($field->options) ? $field->options : json_decode($field->options, true);
                        if ($options) {
                            $fieldRules[] = 'in:' . implode(',', array_keys($options));
                        }
                    }
                    break;
            }

            $rules[$field->name] = implode('|', $fieldRules);
        }

        return $rules;
    }

    /**
     * Process and clean form data
     */
    private function processFormData($request, $form)
    {
        $formData = [];

        foreach ($form->fields as $field) {
            $value = $request->input($field->name);

            // Handle file uploads
            if ($field->type === 'file' && $request->hasFile($field->name)) {
                $file = $request->file($field->name);
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/registrations', $filename, 'public');
                $formData[$field->name] = $path;
            } else {
                $formData[$field->name] = $value;
            }
        }

        return $formData;
    }

    /**
     * Send confirmation email to registrant
     */
    private function sendConfirmationEmail($registration, $formData)
    {
        // Find email field
        $emailField = null;
        $emailValue = null;

        foreach ($registration->form->fields as $field) {
            if ($field->type === 'email') {
                $emailField = $field;
                $emailValue = $formData[$field->name] ?? null;
                break;
            }
        }

        if ($emailValue) {
            try {
                // Send confirmation email (implement your email template)
                Mail::send('emails.registration-confirmation', [
                    'registration' => $registration,
                    'formData' => $formData,
                    'form' => $registration->form
                ], function ($message) use ($emailValue) {
                    $message->to($emailValue)
                           ->subject('Registration Confirmation - ' . config('app.name'));
                });
            } catch (\Exception $e) {
                Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }
        }
    }
}
