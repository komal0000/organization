<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function general(Request $request){
        if(isGet()){
            $data=getSetting('general');

            return view('back.setting.general',compact('data'));
        }else{
            $olddata=getSetting('general');
            $data=[
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'district'=>$request->district,
                'state'=>$request->state,
                'country'=>$request->country,
                'fb'=>$request->fb,
                'insta'=>$request->insta,
                'twitter'=>$request->twitter,
                'youtube'=>$request->youtube,
            ];
            if($request->hasFile('header_logo')){
                $data['header_logo']=$request->header_logo->store('uploads/general');
            }else{
                $data['header_logo']=$olddata->header_logo;
            }
            if($request->hasFile('footer_logo')){
                $data['footer_logo']=$request->footer_logo->store('uploads/general');
            }else{
                $data['footer_logo']=$olddata->footer_logo;
            }
            setSetting('general',$data);
            return redirect()->back()->with('message','Setting Updated');
        }
    }

    public function donation(Request $request){
        if(isGet()){
            $data=getSetting('donation');

            return view('back.setting.donation',compact('data'));
        }else{
            $olddata=getSetting('donation');
            $data=[
                'title'=>$request->title,
                'about'=>$request->about,
                'extra'=>$request->extra,
            ];
            if($request->hasFile('qr')){
                $data['qr']=$request->qr->store('uploads/donation');
            }else{
                $data['qr']=$olddata->qr;
            }

            setSetting('donation',$data);
            return redirect()->back()->with('message','Setting Updated');
        }
    }

    public function fb(Request $request){
        if(isGet()){
            $data=getSetting('fb');
            return view('back.setting.fb',compact('data'));
        }else{
            $data=[
                'data'=>$request->data,
            ];
            setSetting('fb',$data);
            file_put_contents(resource_path('views/front/cache/fb.blade.php'),$request->data);
            return redirect()->back()->with('message','Setting Updated');
        }
    }

    public function contact(Request $request){
        if(isGet()){
            $data=getSetting('contact');
            return view('back.setting.contact',compact('data'));
        }else{
            $oldData=getSetting('contact');
            $data=[
                'map'=>$request->map??""
            ];
            setSetting('contact',$data);
            file_put_contents(resource_path('views/front/cache/page/contact.blade.php'),view('back.setting.template.contact',compact('data'))->render());
        }
    }


    public function meta(Request $request){
        if(isGet()){
            $data=getSetting('meta');
            return view('back.setting.meta',compact('data'));
        }else{
            $oldData=getSetting('meta');
            $data=[
                'title'=>$request->title??"",
                'description'=>$request->description??""
            ];
            if($request->hasFile('feature_image')){
                $data['feature_image']=$request->feature_image->store('uploads/donation');
            }else{
                $data['feature_image']=$oldData->feature_image;
            }
            setSetting('meta',$data);
            file_put_contents(resource_path('views/front/cache/page/meta.blade.php'),view('back.setting.template.meta',compact('data'))->render());
            file_put_contents(resource_path('views/front/cache/home/meta.blade.php'),view('back.setting.template.meta',compact('data'))->render());
            return redirect()->back();
        }
    }

    public function password(Request $request){
        if(isGet()){
            return view('back.setting.password');

        }else{
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:4|confirmed',
            ]);

            $user = Auth::user();

            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->route('admin.index')->with('message', 'Password changed successfully');
            }

            return back()->with('error' ,'The current password is incorrect');
        }
    }

}
