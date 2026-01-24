<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Startup;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index(){
        $startups = Startup::orderBy('id', 'desc')->get();
        return view('back.startups.index', compact('startups'));
    }

    public function add(Request $request){
        if(isGet()){
            return view('back.startups.add');
        }else{
            $request->validate([
                'name_of_firm' => 'required|string|max:255',
                'project_name' => 'nullable|string|max:255',
                'year_of_operation' => 'required|string|max:255',
                'size_of_company' => 'required|string|max:255',
                'location_of_firm' => 'required|string|max:255',
                'gender_of_entrepreneurs' => 'required|string|max:255',
                'status_of_firm' => 'required|string|max:255',
            ]);

            $startup = new Startup();
            $startup->name_of_firm = $request->name_of_firm;
            $startup->project_name = $request->project_name;
            $startup->project_name = $request->project_name;
            $startup->year_of_operation = $request->year_of_operation;
            $startup->size_of_company = $request->size_of_company;
            $startup->location_of_firm = $request->location_of_firm;
            $startup->gender_of_entrepreneurs = $request->gender_of_entrepreneurs;
            $startup->sector = $request->sector ?? '';
            $startup->status_of_firm = $request->status_of_firm;

            $startup->save();
            return redirect()->route('admin.startups.index')->with('message','Startup Added Successfully');
        }
    }

    public function edit(Request $request, Startup $startup){
        if(isGet()){
            return view('back.startups.edit', compact('startup'));
        }else{
            $request->validate([
                'name_of_firm' => 'required|string|max:255',
                'project_name' => 'nullable|string|max:255',
                'year_of_operation' => 'required|string|max:255',
                'size_of_company' => 'required|string|max:255',
                'location_of_firm' => 'required|string|max:255',
                'gender_of_entrepreneurs' => 'required|string|max:255',
                'status_of_firm' => 'required|string|max:255',
            ]);

            $startup->name_of_firm = $request->name_of_firm;
            $startup->project_name = $request->project_name;
            $startup->year_of_operation = $request->year_of_operation;
            $startup->size_of_company = $request->size_of_company;
            $startup->location_of_firm = $request->location_of_firm;
            $startup->gender_of_entrepreneurs = $request->gender_of_entrepreneurs;
            $startup->sector = $request->sector ?? '';
            $startup->status_of_firm = $request->status_of_firm;

            $startup->save();
            return redirect()->route('admin.startups.index')->with('message','Startup Updated Successfully');
        }
    }

    public function del(Request $request, Startup $startup){
        $startup->delete();
        return redirect()->route('admin.startups.index')->with('message','Startup Deleted Successfully');
    }
}
