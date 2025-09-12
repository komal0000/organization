<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index(Notice $notice){
        $members=DB::table('teams')->where('notice_id',$notice->id)
        ->orderBy('pos','asc')
        ->get();

        return view('back.teams.index',compact('notice','members'));
    }

    public function add(Request $request,Notice $notice){
        if(isGet()){
            return view('back.teams.add',compact('notice'));
        }else{
            $team=new Team();
            $team->notice_id=$notice->id;
            $team->name=$request->name;
            $team->desig=$request->desig;
            $team->address=$request->address??"";
            $team->phone=$request->phone??"";
            $team->email=$request->email??"";
            $team->image=$request->image->store('uploads/members');
            $team->save();
            $this->render();
            delMember($team->notice_id);

            return redirect()->back()->with('message','member added successfully');
        }
    }

    public function edit(Request $request,Team $team){
        if(isGet()){
            return view('back.teams.edit',compact('team'));
        }else{
            $team->name=$request->name;
            $team->desig=$request->desig;
            $team->address=$request->address??"";
            $team->phone=$request->phone??"";
            $team->email=$request->email??"";
            if($request->hasFile('image')){
                $team->image=$request->image->store('uploads/members');
            }
            $team->save();
            $this->render();
            delMember($team->notice_id);

            return redirect()->back()->with('message','member updated successfully');
        }
    }

    public function del(Request $request,Team $team){

            delMember($team->notice_id);
            $team->delete();
            $this->render();
            return redirect()->back()->with('message','member deleted successfully');

    }

    public function render(){
        $notice=Notice::where('type',4)->where('is_main',1)->first();
        if($notice!=null){
            $teams=Team::where('notice_id',$notice->id)->take(4)->get();
            file_put_contents(resource_path('views/front/cache/home/members.blade.php'),view('back.notice.template.homemembers',compact('notice','teams'))->render());
        }
    }

    public function setMain($id){
        Notice::where('type',4)->update(['is_main'=>0]);
        Notice::where('type',4)->where('id',$id)->update(['is_main'=>1]);
        $this->render();

        return redirect()->back();
    }

}
