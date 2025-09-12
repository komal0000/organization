<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders=Slider::all();
        return view('back.slider.index',compact('sliders'));
    }

    public function add(Request $request){
        if(isGet()){
            return view('back.slider.add');
        }else{
            $slider=new Slider();
            $slider->title=$request->title??"";
            $slider->subtitle=$request->subtitle??"";
            $slider->link=$request->link??'';
            $slider->btntitle=$request->btntitle??'';
            $slider->image=$request->image->store('uploads/slider');
            $slider->mobile_image=$request->mobile_image->store('uploads/slider');
            $slider->save();
            $this->render();
            return redirect()->back()->with('message','Slider Added Sucessfully');
        }
    }

    public function edit(Request $request,Slider $slider){
        if(isGet()){

            return view('back.slider.edit',compact('slider'));
        }else{
            $slider->title=$request->title??"";
            $slider->subtitle=$request->subtitle??"";
            $slider->link=$request->link??'';
            $slider->btntitle=$request->btntitle??'';
            if($request->hasFile('slider')){

                $slider->image=$request->image->store('uploads/slider');
            }
            if($request->hasFile('mobile_slider')){
                $slider->mobile_image=$request->mobile_image->store('uploads/slider');

            }
            $slider->save();
            $this->render();
            return redirect()->back()->with('message','Slider Updated Sucessfully');
        }
    }

    public function del(Request $request,Slider $slider){
        $slider->delete();
        $this->render();
        return redirect()->back()->with('message','Slider Deleted Sucessfully');

    }

    function render(){
        $sliders=Slider::all();
        file_put_contents(resource_path('views/front/cache/home/slider.blade.php'),view('back.slider.template',compact('sliders'))->render());
    }



}
