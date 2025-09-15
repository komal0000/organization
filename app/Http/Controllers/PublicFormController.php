<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormResponse;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function show($slug)
    {
        $form = Form::where('slug', $slug)
                   ->where('is_active', true)
                   ->with('fields')
                   ->firstOrFail();

        return view('front.form.show', compact('form'));
    }

    public function submit(Request $request, $slug)
    {
        $form = Form::where('slug', $slug)
                   ->where('is_active', true)
                   ->with('fields')
                   ->firstOrFail();

        // Build validation rules dynamically
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
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    break;
            }

            $rules[$field->name] = implode('|', $fieldRules);
        }

        $validatedData = $request->validate($rules);

        // Handle file uploads
        foreach ($form->fields as $field) {
            if ($field->type === 'file' && $request->hasFile($field->name)) {
                $validatedData[$field->name] = $request->file($field->name)->store('uploads/forms');
            }
        }

        // Store the response
        FormResponse::create([
            'form_id' => $form->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'responses' => $validatedData
        ]);

        return view('front.form.success', compact('form'));
    }

    public function csic()
    {
        return view('front.pages.csic');
    }
}
