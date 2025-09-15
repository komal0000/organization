<?php

namespace Database\Seeders;

use App\Models\MembershipContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [
                'section_key' => 'hero_title',
                'section_name' => 'Hero Section Title',
                'content_type' => 'text',
                'content' => 'Become a Member',
                'description' => 'Main title displayed in the hero section',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'hero_subtitle',
                'section_name' => 'Hero Section Subtitle',
                'content_type' => 'textarea',
                'content' => 'Join our community and unlock exclusive benefits, networking opportunities, and resources to grow your career and business.',
                'description' => 'Subtitle text displayed below the main title',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section_key' => 'benefits_title',
                'section_name' => 'Benefits Section Title',
                'content_type' => 'text',
                'content' => 'Membership Benefits',
                'description' => 'Title for the benefits section',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section_key' => 'benefits_content',
                'section_name' => 'Benefits Section Content',
                'content_type' => 'rich_text',
                'content' => '<p>As a member, you will enjoy:</p>
                             <ul>
                                 <li>Access to exclusive networking events and meetups</li>
                                 <li>Professional development workshops and seminars</li>
                                 <li>Business collaboration opportunities</li>
                                 <li>Industry insights and resources</li>
                                 <li>Member directory and communication platform</li>
                                 <li>Discounts on events and services</li>
                             </ul>',
                'description' => 'Detailed benefits content with HTML formatting',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section_key' => 'additional_info_title',
                'section_name' => 'Additional Info Section Title',
                'content_type' => 'text',
                'content' => 'Ready to Join?',
                'description' => 'Title for the additional information section',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section_key' => 'additional_info_content',
                'section_name' => 'Additional Info Section Content',
                'content_type' => 'textarea',
                'content' => 'Take the first step towards growing your network and advancing your career. Fill out the membership application above and become part of our thriving community.',
                'description' => 'Content for the additional information section',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'section_key' => 'requirements_title',
                'section_name' => 'Requirements Section Title',
                'content_type' => 'text',
                'content' => 'Membership Requirements',
                'description' => 'Title for membership requirements section',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'section_key' => 'requirements_content',
                'section_name' => 'Requirements Section Content',
                'content_type' => 'rich_text',
                'content' => '<p>To become a member, you must meet the following criteria:</p>
                             <ul>
                                 <li>Be actively involved in business or professional activities</li>
                                 <li>Demonstrate commitment to professional growth and community involvement</li>
                                 <li>Agree to participate in member activities and events</li>
                                 <li>Complete the application process and provide required information</li>
                             </ul>
                             <p>All applications are reviewed by our membership committee to ensure quality and alignment with our community values.</p>',
                'description' => 'Detailed membership requirements',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'section_key' => 'process_title',
                'section_name' => 'Application Process Title',
                'content_type' => 'text',
                'content' => 'Application Process',
                'description' => 'Title for the application process section',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'section_key' => 'process_content',
                'section_name' => 'Application Process Content',
                'content_type' => 'rich_text',
                'content' => '<div class="process-steps">
                                 <div class="step">
                                     <h4>1. Submit Application</h4>
                                     <p>Complete the online membership application form with your personal and professional information.</p>
                                 </div>
                                 <div class="step">
                                     <h4>2. Review Process</h4>
                                     <p>Our membership committee will review your application within 3-5 business days.</p>
                                 </div>
                                 <div class="step">
                                     <h4>3. Welcome to the Community</h4>
                                     <p>Upon approval, you\'ll receive welcome information and access to member resources.</p>
                                 </div>
                             </div>',
                'description' => 'Step-by-step application process',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            MembershipContent::updateOrCreate(
                ['section_key' => $content['section_key']],
                $content
            );
        }
    }
}
