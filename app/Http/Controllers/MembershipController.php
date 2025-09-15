<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\MembershipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    public function index()
    {
        $content = MembershipContent::getAllActiveContent();
        return view('front.membership.index', compact('content'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:memberships,email',
            'phone_number' => 'required|string|max:20',
            'residential_area' => 'nullable|string',
            'chapter_applying_for' => 'nullable|string|max:255',
            'nepali_citizen' => 'nullable|in:yes,no',
            'academic_qualification' => 'nullable|string',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'organization_member' => 'nullable|string',
            'sector' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url',
            'number_of_employees' => 'nullable|integer|min:0',
            'organization_telephone' => 'nullable|string|max:20',
            'organization_email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $membership = Membership::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Your membership application has been submitted successfully!',
                'membership_id' => $membership->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error submitting your application. Please try again.'
            ], 500);
        }
    }

    public function success()
    {
        return view('front.membership.success');
    }
}
