<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of active programs
     */
    public function index()
    {
        $programs = Program::active()
                          ->ordered()
                          ->paginate(12);

        $featuredPrograms = Program::active()
                                  ->featured()
                                  ->ordered()
                                  ->limit(6)
                                  ->get();

        return view('front.programs.index', compact('programs', 'featuredPrograms'));
    }

    /**
     * Display the specified program
     */
    public function show(Program $program)
    {
        // Check if program is active
        if (!$program->is_active) {
            abort(404);
        }

        // Get related programs (excluding current program)
        $relatedPrograms = Program::active()
                                 ->where('id', '!=', $program->id)
                                 ->ordered()
                                 ->limit(3)
                                 ->get();

        return view('front.programs.show', compact('program', 'relatedPrograms'));
    }

    /**
     * Get featured programs for homepage or other sections
     */
    public function featured()
    {
        $featuredPrograms = Program::active()
                                  ->featured()
                                  ->ordered()
                                  ->limit(6)
                                  ->get();

        return response()->json($featuredPrograms);
    }
}
