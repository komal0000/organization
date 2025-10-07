<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $reports = Report::orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();
        return view('back.reports.index', compact('reports'));
    }

    public function add(Request $request){
        if(isGet()){
            return view('back.reports.add');
        }else{
            $request->validate([
                'title' => 'required|string|max:255',
                'document' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
                'sort_order' => 'integer|min:0'
            ]);

            $report = new Report();
            $report->title = $request->title;
            $report->description = $request->description ?? "";
            $report->sort_order = $request->sort_order ?? 0;
            
            if($request->hasFile('document')){
                $report->document = $request->document->store('uploads/reports');
            }
            
            $report->save();
            $this->render();
            return redirect()->back()->with('message','Report Added Successfully');
        }
    }

    public function edit(Request $request, Report $report){
        if(isGet()){
            return view('back.reports.edit', compact('report'));
        }else{
            $request->validate([
                'title' => 'required|string|max:255',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
                'sort_order' => 'integer|min:0'
            ]);

            $report->title = $request->title;
            $report->description = $request->description ?? "";
            $report->sort_order = $request->sort_order ?? 0;
            
            if($request->hasFile('document')){
                $report->document = $request->document->store('uploads/reports');
            }
            
            $report->save();
            $this->render();
            return redirect()->back()->with('message','Report Updated Successfully');
        }
    }

    public function del(Request $request, Report $report){
        // Delete the file if it exists
        if ($report->document && file_exists(public_path($report->document))) {
            unlink(public_path($report->document));
        }
        
        $report->delete();
        $this->render();
        return redirect()->back()->with('message','Report Deleted Successfully');
    }

    function render(){
        $reports = Report::getOrdered();
        file_put_contents(resource_path('views/front/cache/page/reports.blade.php'), view('back.reports.template', compact('reports'))->render());
        clearReportsCache();
    }
}