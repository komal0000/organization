<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class SettingMemory{
    public static $data=[];
}
function getSetting($code,$original=false){

    if(!isset(SettingMemory::$data[$code])){
        SettingMemory::$data[$code]= Cache::rememberForever($code.'_'.($original?'original':'json'),function() use($original,$code){
            $value=(DB::table('settings')->where('code',$code)->first()??((object)['value'=>'']))->value;
            if($original){
                return $value;
            }else{
                if($value==""){
                    return (object)[];
                }else{
                    return json_decode($value);
                }
            }
        });

    }
    return SettingMemory::$data[$code];
}

function setSetting($code,$value,$original=false){
    if(!$original){
        $value=json_encode($value);
    }

    DB::insert("INSERT INTO settings (code, value)
    VALUES (?, ?) ON DUPLICATE KEY UPDATE value = ?",[$code,$value,$value]);
    Cache::forget($code.'_'.($original?'original':'json'));
    try {
        unset( SettingMemory::$data[$code]);
    } catch (\Throwable $th) {
    }
}

function vasset($path){
    return asset($path)."?v=".config('app.version');
}

function isGet() {
    return request()->getMethod()=="GET";
}


function noticeType($type){
    return ['','Notice','News','Issue','Teams','Gallery','FAQ','Issue','About US'][$type];
}

function noticeDate($notice){
    return Carbon::parse($notice->created_at)->format('d M, Y');

}


function clearNewMini(){
     Cache::forget('news_mini');
}

function newsMini(){
    return Cache::rememberForever('news_mini',function(){
        return DB::table('notices')->where('type',2)->orderBy('id','desc')->get(['id','slug as s','title as t','file as f','created_at'])
        ->map((function($news){
            return (object)[
                'id'=>$news->id,
                's'=>$news->s,
                't'=>$news->t,
                'f'=>asset($news->f),
                'date'=>noticeDate($news),
            ];
        }));
    });
}

function getGallery($id){
    return Cache::rememberForever('gallery_'.$id,function()use($id){
        return DB::table('galleries')->where('notice_id',$id)->get(['file','thumb']);
    });
}

function delGallery($id){
    return Cache::forget('gallery_'.$id);
}

function getFAQ(){
    return Cache::rememberForever('faq',function(){
        return DB::table('notices')->where('type',6)->get(['title','short_desc']);
    });
}

function delFAQ(){
    return Cache::forget('faq');
}

function getComities(){
    return Cache::rememberForever('comities',function(){
        return DB::table('notices')->where('type',4)->get(['id','title','short_desc','is_main','slug']);
    });
}

function delComities(){
    Cache::forget('comities');
}

function getMember($notice_id){
    return Cache::rememberForever('member_'.$notice_id,function()use($notice_id){
        return DB::table('teams')->where('notice_id',$notice_id)->orderBy('pos','asc')->get();
    });
}

function delMember($notice_id){
    return Cache::forget('member_'.$notice_id);

}


function getSingleGallery($slug){
    return Cache::rememberForever($slug,function()use($slug){
        $gallery=DB::table('notices')->where('slug',$slug)->first(['id','title']);
        $gallery->images=getGallery($gallery->id);
        return $gallery;
    });
}
function delSingleGallery($slug,$id){
    Cache::forget($slug);
    delGallery($id);
}



function createThumbnail($sourceFilePath, $destinationDirectory, $maxWidth = 150, $maxHeight = 150)
{
    if (!file_exists($sourceFilePath)) {
        return false;
    }

    $fileExtension = strtolower(pathinfo($sourceFilePath, PATHINFO_EXTENSION));
    $supportedFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($fileExtension, $supportedFormats)) {
        return false;
    }

    switch ($fileExtension) {
        case 'jpg':
        case 'jpeg':
            $originalImage = imagecreatefromjpeg($sourceFilePath);
            break;
        case 'png':
            $originalImage = imagecreatefrompng($sourceFilePath);
            break;
        case 'gif':
            $originalImage = imagecreatefromgif($sourceFilePath);
            break;
        case 'webp':
            $originalImage = imagecreatefromwebp($sourceFilePath);
            break;
        default:
            return false;
    }

    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);

    if ($originalWidth > $originalHeight) {
        $newWidth = $maxWidth;
        $newHeight = ($originalHeight / $originalWidth) * $maxWidth;
    } else {
        $newHeight = $maxHeight;
        $newWidth = ($originalWidth / $originalHeight) * $maxHeight;
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    $fileNameWithoutExtension = pathinfo($sourceFilePath, PATHINFO_FILENAME);
    $thumbnailFileName = $fileNameWithoutExtension . '_thumb.' . $fileExtension;
    $retpath = $destinationDirectory . '/' . $thumbnailFileName;
    $thumbnailFilePath=public_path($retpath);

    switch ($fileExtension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($newImage, $thumbnailFilePath);
            break;
        case 'png':
            imagepng($newImage, $thumbnailFilePath);
            break;
        case 'gif':
            imagegif($newImage, $thumbnailFilePath);
            break;
        case 'webp':
            imagewebp($newImage, $thumbnailFilePath);
            break;
    }

    imagedestroy($originalImage);
    imagedestroy($newImage);

    return $retpath;
}



function casset($path){
    return config('app.CLOUDINARY_public').$path;
}

function cloudinaryUpload($filePath){
    Configuration::instance(config('app.CLOUDINARY_URL'));
    $fileInfo = pathinfo($filePath);
    $fileName = $fileInfo['filename'];

    $upload = new UploadApi();
    $info= $upload->upload($filePath, [
            'public_id' => $fileName,
            'use_filename' => TRUE,
            'overwrite' => TRUE]);
    return  str_replace(
        config('app.CLOUDINARY_public'),
        "",
        (json_decode(json_encode($info)))->secure_url
    );
}
