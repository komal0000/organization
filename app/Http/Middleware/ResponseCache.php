<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class ResponseCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $path = public_path($request->path()).DIRECTORY_SEPARATOR.'index.php';
        // if(File::exists($path)){
        //     return response(file_get_contents($path));
        // }
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $path = public_path('cache');
        $reqPath=rtrim($request->path(),"/");
        if($reqPath==''){
            $reqPath="home";
        }
        file_put_contents($path.DIRECTORY_SEPARATOR.(str_replace("/","_",$reqPath)).'.php',$response->getContent());
    }
}
