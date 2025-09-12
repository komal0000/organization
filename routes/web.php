<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\GalleryController;
use App\Http\Controllers\Back\NoticeController;
use App\Http\Controllers\Back\SliderController;
use App\Http\Controllers\Back\TeamController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\LoginController;
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
    });


});
