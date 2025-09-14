<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function general(Request $request)
    {
        if (isGet()) {
            $data = getSetting('general');

            return view('back.setting.general', compact('data'));
        } else {
            $olddata = getSetting('general');
            $data = [
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'district' => $request->district,
                'state' => $request->state,
                'country' => $request->country,
                'fb' => $request->fb,
                'insta' => $request->insta,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
            ];
            if ($request->hasFile('header_logo')) {
                $data['header_logo'] = $request->header_logo->store('uploads/general');
            } else {
                $data['header_logo'] = $olddata->header_logo;
            }
            if ($request->hasFile('footer_logo')) {
                $data['footer_logo'] = $request->footer_logo->store('uploads/general');
            } else {
                $data['footer_logo'] = $olddata->footer_logo;
            }
            setSetting('general', $data);
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }

    public function donation(Request $request)
    {
        if (isGet()) {
            $data = getSetting('donation');

            return view('back.setting.donation', compact('data'));
        } else {
            $olddata = getSetting('donation');
            $data = [
                'title' => $request->title,
                'about' => $request->about,
                'extra' => $request->extra,
            ];
            if ($request->hasFile('qr')) {
                $data['qr'] = $request->qr->store('uploads/donation');
            } else {
                $data['qr'] = $olddata->qr;
            }

            setSetting('donation', $data);
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }

    public function homeFAQ(Request $request)
    {
        if (isGet()) {
            $data = getSetting('homeFAQ');
            return view('back.setting.homefaq', compact('data'));
        } else {
            $data = [
                'title' => $request->title ?? '',
                'subtitle' => $request->subtitle ?? '',
                'semi' => $request->semi ?? '',
                'bottom_text' => $request->bottom_text ?? '',
            ];
            setSetting('homeFAQ', $data);

            // Clear view cache before writing new cache file
            Artisan::call('view:clear');

            file_put_contents(resource_path('views/front/cache/homeFAQ.blade.php'), view('back.setting.template.homefaq', compact('data'))->render());
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }
    public function fb(Request $request)
    {
        if (isGet()) {
            $data = getSetting('fb');
            return view('back.setting.fb', compact('data'));
        } else {
            $data = [
                'data' => $request->data,
            ];
            setSetting('fb', $data);

            // Clear view cache before writing new cache file
            Artisan::call('view:clear');

            file_put_contents(resource_path('views/front/cache/fb.blade.php'), $request->data);
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }

    public function contact(Request $request)
    {
        if (isGet()) {
            $data = getSetting('contact');
            return view('back.setting.contact', compact('data'));
        } else {
            $oldData = getSetting('contact');
            $data = [
                'map' => $request->map ?? ""
            ];
            setSetting('contact', $data);

            // Clear view cache before writing new cache file
            Artisan::call('view:clear');

            file_put_contents(resource_path('views/front/cache/page/contact.blade.php'), view('back.setting.template.contact', compact('data'))->render());
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }


    public function meta(Request $request)
    {
        if (isGet()) {
            $data = getSetting('meta');
            return view('back.setting.meta', compact('data'));
        } else {
            $oldData = getSetting('meta');
            $data = [
                'title' => $request->title ?? "",
                'description' => $request->description ?? ""
            ];
            if ($request->hasFile('feature_image')) {
                $data['feature_image'] = $request->feature_image->store('uploads/donation');
            } else {
                $data['feature_image'] = $oldData->feature_image;
            }
            setSetting('meta', $data);

            // Clear view cache before writing new cache files
            Artisan::call('view:clear');

            file_put_contents(resource_path('views/front/cache/page/meta.blade.php'), view('back.setting.template.meta', compact('data'))->render());
            file_put_contents(resource_path('views/front/cache/home/meta.blade.php'), view('back.setting.template.meta', compact('data'))->render());
            return redirect()->back()->with('message', 'Setting Updated');
        }
    }

    public function password(Request $request)
    {
        if (isGet()) {
            return view('back.setting.password');
        } else {
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

            return back()->with('error', 'The current password is incorrect');
        }
    }

    public function homeObjectives(Request $request)
    {
        if (isGet()) {
            $data = getSetting('homeObjectives');
            return view('back.setting.home-objectives', compact('data'));
        } else {
            $objectives = [];
            if ($request->has('objectives')) {
                foreach ($request->objectives as $index => $objective) {
                    if (!empty($objective['title'])) {
                        $objectives[] = [
                            'title' => $objective['title'],
                            'icon' => $objective['icon'] ?? 'fas fa-bullseye'
                        ];
                    }
                }
            }

            $data = [
                'section_title' => $request->section_title ?? 'Our Objectives',
                'section_subtitle' => $request->section_subtitle ?? 'What we aim to achieve',
                'objectives' => $objectives,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            setSetting('homeObjectives', $data);

            // Clear view cache before writing new cache file
            Artisan::call('view:clear');
            file_put_contents(resource_path('views/front/cache/home/objectives.blade.php'), view('back.setting.template.home-objectives', compact('data'))->render());
            return redirect()->back()->with('message', 'Objectives Setting Updated');
        }
    }

    public function homeVisionGoalsMission(Request $request)
    {
        if (isGet()) {
            $data = getSetting('homeVisionGoalsMission');
            return view('back.setting.home-vision-goals-mission', compact('data'));
        } else {
            $data = [
                'vision_title' => $request->vision_title ?? 'Our Vision',
                'vision_description' => $request->vision_description ?? 'Our vision for the future.',
                'mission_title' => $request->mission_title ?? 'Our Mission',
                'mission_description' => $request->mission_description ?? 'Our core mission and approach.',
                'goals_title' => $request->goals_title ?? 'Our Goals',
                'goals_description' => $request->goals_description ?? 'Our specific goals and targets.',
                'section_title' => $request->section_title ?? 'Vision, Mission & Goals',
                'section_subtitle' => $request->section_subtitle ?? 'Our direction and purpose',
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            setSetting('homeVisionGoalsMission', $data);

            // Clear view cache before writing new cache file
            Artisan::call('view:clear');
            file_put_contents(resource_path('views/front/cache/home/vision-goals-mission.blade.php'), view('back.setting.template.home-vision-goals-mission', compact('data'))->render());
            return redirect()->back()->with('message', 'Vision, Goals & Mission Setting Updated');
        }
    }

    public function homeStatistics(Request $request)
    {
        if (isGet()) {
            $data = getSetting('homeStatistics');
            return view('back.setting.home-statistics', compact('data'));
        } else {
            $statistics = [];
            if ($request->has('statistics')) {
                foreach ($request->statistics as $index => $statistic) {
                    if (!empty($statistic['title']) && !empty($statistic['value'])) {
                        $statistics[] = [
                            'title' => $statistic['title'],
                            'value' => $statistic['value'],
                            'icon' => $statistic['icon'] ?? 'fas fa-chart-line'
                        ];
                    }
                }
            }

            $data = [
                'section_title' => $request->section_title ?? 'Our Impact',
                'section_subtitle' => $request->section_subtitle ?? 'Making a difference together',
                'statistics' => $statistics,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ];
            setSetting('homeStatistics', $data);

            // Clear view cache before writing new cache file
            // Artisan::call('view:clear');
            file_put_contents(resource_path('views/front/cache/home/statistics.blade.php'), view('back.setting.template.home-statistics', compact('data'))->render());
            return redirect()->back()->with('message', 'Statistics Setting Updated');
        }
    }
}
