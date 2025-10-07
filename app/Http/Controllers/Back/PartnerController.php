<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(){
        $partners = Partner::orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        return view('back.partners.index', compact('partners'));
    }

    public function add(Request $request){
        if(isGet()){
            return view('back.partners.add');
        }else{
            $partner = new Partner();
            $partner->name = $request->name ?? "";
            $partner->link = $request->link ?? "";
            $partner->sort_order = $request->sort_order ?? 0;
            
            if($request->hasFile('image')){
                $partner->image = $request->image->store('uploads/partners');
            }
            
            $partner->save();
            $this->render();
            return redirect()->back()->with('message','Partner Added Successfully');
        }
    }

    public function edit(Request $request, Partner $partner){
        if(isGet()){
            return view('back.partners.edit', compact('partner'));
        }else{
            $partner->name = $request->name ?? "";
            $partner->link = $request->link ?? "";
            $partner->sort_order = $request->sort_order ?? 0;
            
            if($request->hasFile('image')){
                $partner->image = $request->image->store('uploads/partners');
            }
            
            $partner->save();
            $this->render();
            return redirect()->back()->with('message','Partner Updated Successfully');
        }
    }

    public function del(Request $request, Partner $partner){
        $partner->delete();
        $this->render();
        return redirect()->back()->with('message','Partner Deleted Successfully');
    }

    function render(){
        $partners = Partner::getOrdered();
        file_put_contents(resource_path('views/front/cache/home/partners.blade.php'), view('back.partners.template', compact('partners'))->render());
        clearPartnersCache();
    }
}