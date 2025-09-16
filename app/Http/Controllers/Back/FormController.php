<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->orderBy('created_at', 'desc')->get();
        return view('back.form.index', compact('forms'));
    }

    public function create()
    {
        return view('back.form.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'description' => 'nullable|string'
        ]);

        $form = Form::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'slug' => Str::slug($request->title . '-' . $request->year),
            'is_active' => $request->is_active ?? 1
        ]);

        return redirect()->route('admin.admin_form_edit', $form->id)
                        ->with('success', 'Form created successfully! Now add fields to your form.');
    }

    public function edit(Form $form)
    {
        $form->load('fields');
        return view('back.form.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'description' => 'nullable|string'
        ]);

        $form->update([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->back()->with('message', 'Form updated successfully!');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.admin_form_index')->with('message', 'Form deleted successfully!');
    }

    public function addField(Request $request, Form $form)
    {
        $request->validate([
            'type' => 'required|in:text,textarea,email,number,date,select,radio,checkbox,file',
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|regex:/^[a-z_]+$/',
            'placeholder' => 'nullable|string|max:255',
            'help_text' => 'nullable|string|max:500',
            'options' => 'nullable|string',
            'is_required' => 'boolean'
        ]);

        // Check if field name already exists for this form
        if ($form->fields()->where('name', $request->name)->exists()) {
            return back()->withErrors(['name' => 'Field name already exists for this form.']);
        }

        $options = null;
        if (in_array($request->type, ['select', 'radio', 'checkbox']) && $request->options) {
            $options = array_filter(explode("\n", trim($request->options)));
        }

        $form->fields()->create([
            'type' => $request->type,
            'label' => $request->label,
            'name' => $request->name,
            'placeholder' => $request->placeholder,
            'help_text' => $request->help_text,
            'options' => $options,
            'is_required' => $request->boolean('is_required'),
            'order' => $form->fields()->max('order') + 1
        ]);

        return back()->with('success', 'Field added successfully!');
    }

    public function editField(Form $form, FormField $field)
    {
        if ($field->form_id !== $form->id) {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'field' => [
                'id' => $field->id,
                'type' => $field->type,
                'label' => $field->label,
                'name' => $field->name,
                'placeholder' => $field->placeholder,
                'help_text' => $field->help_text,
                'options' => $field->options ? implode("\n", $field->options) : '',
                'is_required' => $field->is_required
            ]
        ]);
    }

    public function updateField(Request $request, Form $form, FormField $field)
    {
        if ($field->form_id !== $form->id) {
            abort(404);
        }

        $request->validate([
            'type' => 'required|in:text,textarea,email,number,date,select,radio,checkbox,file',
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|regex:/^[a-z_]+$/',
            'placeholder' => 'nullable|string|max:255',
            'help_text' => 'nullable|string|max:500',
            'options' => 'nullable|string',
            'is_required' => 'boolean'
        ]);

        // Check if field name already exists for this form (excluding current field)
        if ($form->fields()->where('name', $request->name)->where('id', '!=', $field->id)->exists()) {
            return back()->withErrors(['name' => 'Field name already exists for this form.']);
        }

        $options = null;
        if (in_array($request->type, ['select', 'radio', 'checkbox']) && $request->options) {
            $options = array_filter(explode("\n", trim($request->options)));
        }

        $field->update([
            'type' => $request->type,
            'label' => $request->label,
            'name' => $request->name,
            'placeholder' => $request->placeholder,
            'help_text' => $request->help_text,
            'options' => $options,
            'is_required' => $request->boolean('is_required')
        ]);

        return back()->with('success', 'Field updated successfully!');
    }

    public function deleteField(Form $form, FormField $field)
    {
        if ($field->form_id !== $form->id) {
            abort(404);
        }

        $field->delete();

        return back()->with('success', 'Field deleted successfully!');
    }

    public function responses(Form $form)
    {
        $responses = $form->responses()->latest()->get();

        return view('back.form.responses', compact('form', 'responses'));
    }

    public function deleteResponse(Form $form, FormResponse $response)
    {
        if ($response->form_id !== $form->id) {
            abort(404);
        }

        $response->delete();

        return back()->with('success', 'Response deleted successfully!');
    }
}
