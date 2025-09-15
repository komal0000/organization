<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Membership::orderBy('submitted_at', 'desc');

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $memberships = $query->paginate(20);

        return view('back.membership.applications.index', compact('memberships'));
    }

    public function show(Membership $membership)
    {
        return view('back.membership.applications.show', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $membership->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('message', 'Application status updated successfully!');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('admin.membership-applications.index')
                        ->with('message', 'Application deleted successfully!');
    }
}
