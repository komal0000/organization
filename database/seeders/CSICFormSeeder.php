<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CSICFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if form already exists
        $existingForm = Form::where('slug', 'catalyst-startup-ideas-competition-2025-registration-form')->first();

        if ($existingForm) {
            $this->command->info('CSIC form already exists. Skipping...');
            return;
        }

        // Create the CSIC Catalyst Startup Ideas Competition 2025 form
        $form = Form::create([
            'title' => 'Catalyst Startup Ideas Competition 2025 - Registration Form',
            'year' => '2025',
            'description' => 'The Catalyst Entrepreneurs Society (CES) is proud to announce the Catalyst Startup Idea Competition 2025, scheduled for Bhadra 1st, 2082. This event aims to inspire and empower university-level students to explore the world of entrepreneurship and innovation.',
            'slug' => 'catalyst-startup-ideas-competition-2025-registration-form',
            'is_active' => true,
        ]);

        // Add form fields based on the Google Form
        $fields = [
            [
                'type' => 'text',
                'label' => 'College/University Name',
                'name' => 'college_university_name',
                'placeholder' => 'Your answer',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'type' => 'text',
                'label' => 'College Address',
                'name' => 'college_address',
                'placeholder' => 'Your answer',
                'is_required' => true,
                'order' => 2,
            ],
            [
                'type' => 'text',
                'label' => 'College Contact Person Name',
                'name' => 'college_contact_person_name',
                'placeholder' => 'Your answer',
                'is_required' => true,
                'order' => 3,
            ],
            [
                'type' => 'text',
                'label' => 'College Contact Person Contact Number',
                'name' => 'college_contact_person_contact_number',
                'placeholder' => 'Your answer',
                'is_required' => true,
                'order' => 4,
            ],
            [
                'type' => 'email',
                'label' => 'College Contact Person Email',
                'name' => 'college_contact_person_email',
                'placeholder' => 'Your answer',
                'is_required' => true,
                'order' => 5,
            ],
        ];

        foreach ($fields as $field) {
            FormField::create(array_merge($field, ['form_id' => $form->id]));
        }
    }
}
