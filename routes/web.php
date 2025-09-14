<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\FormController;
use App\Http\Controllers\Back\GalleryController;
use App\Http\Controllers\Back\NoticeController;
use App\Http\Controllers\Back\SliderController;
use App\Http\Controllers\Back\TeamController;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicFormController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/news', [HomeController::class,'news'])->name('news');
    Route::get('/notices', [HomeController::class,'notices'])->name('notices');
    Route::get('/gallery', [HomeController::class,'gallery'])->name('gallery');
    Route::get('/faq', [HomeController::class,'faq'])->name('faq');
    Route::get('/committees', [HomeController::class,'committees'])->name('committees');
    Route::get('/issues', [HomeController::class,'issues'])->name('issues');
    Route::get('/about', [HomeController::class,'about'])->name('about');
    Route::get('/contact', [HomeController::class,'contact'])->name('contact');

    Route::get('/gallery/{slug}', [HomeController::class,'gallerySingle'])->name('gallery.single');
    Route::get('/news/{slug}', [HomeController::class,'newsSingle'])->name('news.single');
    Route::get('/committees/{slug}', [HomeController::class,'committeeSingle'])->name('committee.single');
    Route::get('/issues/{slug}', [HomeController::class,'issueSingle'])->name('issue.single');
    Route::get('/about/{slug}', [HomeController::class,'aboutSingle'])->name('about.single');

    // Public Form Routes
    Route::get('/registration', function() {
        $form = App\Models\Form::where('is_active', true)->first();
        if (!$form) {
            abort(404, 'Registration form not found');
        }
        return redirect()->route('forms.show', $form->slug);
    })->name('registration');
    Route::get('/forms/{slug}', [PublicFormController::class, 'show'])->name('forms.show');
    Route::post('/forms/{slug}', [PublicFormController::class, 'submit'])->name('forms.submit');


Route::match(['GET','POST'],'login',[LoginController::class,'login'])->name('login');
Route::match(['GET','POST'],'logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth','clr'])->group(function(){

    Route::get('',[DashboardController::class,'index'])->name('index');

    Route::prefix('slider')->name('slider.')->group(function(){
        Route::get('',[SliderController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add',[SliderController::class,'add'])->name('add');
        Route::match(['GET','POST'],'edit/{slider}',[SliderController::class,'edit'])->name('edit');
        Route::get('del/{slider}',[SliderController::class,'del'])->name('del');
    });

    Route::prefix('notice')->name('notice.')->group(function(){
        Route::get('index/{type}',[NoticeController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add/{type}',[NoticeController::class,'add'])->name('add');
        Route::match(['GET','POST'],'edit/{notice}',[NoticeController::class,'edit'])->name('edit');
        Route::get('del/{notice}',[NoticeController::class,'del'])->name('del');
        Route::get('main/{notice}',[NoticeController::class,'main'])->name('main');
        Route::get('render/{type}',[NoticeController::class,'render'])->name('render');
        Route::post('image/{type}',[NoticeController::class,'image'])->name('image');
    });

    Route::prefix('team')->name('team.')->group(function(){
        Route::get('index/{notice}',[TeamController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add/{notice}',[TeamController::class,'add'])->name('add');
        Route::match(['GET','POST'],'edit/{team}',[TeamController::class,'edit'])->name('edit');
        Route::get('del/{team}',[TeamController::class,'del'])->name('del');
        Route::get('setmain/{id}',[TeamController::class,'setMain'])->name('setmain');
        Route::get('unsetmain/{id}',[TeamController::class,'unsetMain'])->name('unsetmain');
    });

    Route::prefix('gallery')->name('gallery.')->group(function(){
        Route::get('index/{notice}',[GalleryController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add/{notice}',[GalleryController::class,'add'])->name('add');
        Route::post('del',[GalleryController::class,'del'])->name('del');
    });

    Route::prefix('setting')->name('setting.')->group(function(){
        Route::match(['GET','POST'],'general',[SettingController::class,'general'])->name('general');
        // Route::match(['GET','POST'],'aboutus',[SettingController::class,'aboutus'])->name('aboutus');
        Route::match(['GET','POST'],'donation',[SettingController::class,'donation'])->name('donation');
        Route::match(['GET','POST'],'fb',[SettingController::class,'fb'])->name('fb');
        Route::match(['GET','POST'],'contact',[SettingController::class,'contact'])->name('contact');
        Route::match(['GET','POST'],'meta',[SettingController::class,'meta'])->name('meta');
        Route::match(['GET','POST'],'password',[SettingController::class,'password'])->name('password');
        Route::match(['GET','POST'],'homeFAQ',[SettingController::class,'homeFAQ'])->name('homeFAQ');

        // Home Settings
        Route::match(['GET','POST'],'home-objectives',[SettingController::class,'homeObjectives'])->name('home-objectives');
        Route::match(['GET','POST'],'home-vision-goals-mission',[SettingController::class,'homeVisionGoalsMission'])->name('home-vision-goals-mission');
        Route::match(['GET','POST'],'home-statistics',[SettingController::class,'homeStatistics'])->name('home-statistics');
    });

    Route::prefix('footer-links')->name('footer-links.')->group(function(){
        Route::get('', [FooterLinkController::class, 'index'])->name('index');
        Route::get('create', [FooterLinkController::class, 'create'])->name('create');
        Route::post('', [FooterLinkController::class, 'store'])->name('store');
        Route::get('{id}/edit', [FooterLinkController::class, 'edit'])->name('edit');
        Route::put('{id}', [FooterLinkController::class, 'update'])->name('update');
        Route::delete('{id}', [FooterLinkController::class, 'destroy'])->name('destroy');
    });

    // Admin Form Routes
    Route::get('forms', [FormController::class, 'index'])->name('admin_form_index');
    Route::get('forms/create', [FormController::class, 'create'])->name('admin_form_create');
    Route::post('forms', [FormController::class, 'store'])->name('admin_form_store');
    Route::get('forms/{form}/edit', [FormController::class, 'edit'])->name('admin_form_edit');
    Route::post('forms/{form}', [FormController::class, 'update'])->name('admin_form_update');
    Route::get('forms/{form}/delete', [FormController::class, 'destroy'])->name('admin_form_delete');

    // Form Field Management
    Route::post('forms/{form}/fields', [FormController::class, 'addField'])->name('admin_form_add_field');
    Route::post('forms/{form}/fields/{field}', [FormController::class, 'updateField'])->name('admin_form_update_field');
    Route::get('forms/{form}/fields/{field}/delete', [FormController::class, 'deleteField'])->name('admin_form_delete_field');

    // Form Responses
    Route::get('forms/{form}/responses', [FormController::class, 'responses'])->name('admin_form_responses');
    Route::get('forms/{form}/responses/{response}/delete', [FormController::class, 'deleteResponse'])->name('admin_form_delete_response');

});
