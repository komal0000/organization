<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationApplicationController extends Controller
{
    /**
     * Display a list of registration applications
     */
    public function index(Request $request)
    {
        $query = FormResponse::with('form')->orderBy('submitted_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by form
        if ($request->has('form_id') && $request->form_id !== '') {
            $query->where('form_id', $request->form_id);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('responses', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(20);
        $forms = Form::where('is_active', true)->get();

        return view('back.registration.applications.index', compact('applications', 'forms'));
    }

    /**
     * Display a specific registration application
     */
    public function show(FormResponse $application)
    {
        $application->load('form.fields');
        return view('back.registration.applications.show', compact('application'));
    }

    /**
     * Update application status
     */
    public function update(Request $request, FormResponse $application)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        // Send notification email if status changed to approved or rejected
        if (in_array($request->status, ['approved', 'rejected'])) {
            $this->sendStatusUpdateEmail($application);
        }

        return redirect()->back()->with('message', 'Application status updated successfully!');
    }

    /**
     * Export applications to CSV
     */
    public function export(Request $request)
    {
        $query = FormResponse::with('form');

        // Apply same filters as index
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('form_id') && $request->form_id !== '') {
            $query->where('form_id', $request->form_id);
        }

        $applications = $query->get();

        $filename = 'registration_applications_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');

            // Headers
            fputcsv($file, [
                'ID',
                'Form',
                'Status',
                'Submitted At',
                'IP Address',
                'Responses'
            ]);

            foreach ($applications as $application) {
                fputcsv($file, [
                    $application->id,
                    $application->form->title,
                    $application->status,
                    $application->submitted_at ? $application->submitted_at->format('Y-m-d H:i:s') : '',
                    $application->ip_address,
                    json_encode($application->responses)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete an application
     */
    public function destroy(FormResponse $application)
    {
        $application->delete();

        return redirect()->route('admin.registration-applications.index')
                        ->with('message', 'Application deleted successfully!');
    }

    /**
     * Send status update email
     */
    private function sendStatusUpdateEmail($application)
    {
        // Find email field in the application
        $emailValue = null;

        if ($application->form && $application->form->fields) {
            foreach ($application->form->fields as $field) {
                if ($field->type === 'email' && isset($application->responses[$field->name])) {
                    $emailValue = $application->responses[$field->name];
                    break;
                }
            }
        }

        if ($emailValue) {
            try {
                Mail::send('emails.registration-status-update', [
                    'application' => $application,
                    'form' => $application->form
                ], function ($message) use ($emailValue, $application) {
                    $message->to($emailValue)
                           ->subject('Registration Status Update - ' . config('app.name'));
                });
            } catch (\Exception $e) {
                Log::error('Failed to send status update email: ' . $e->getMessage());
            }
        }
    }
}
