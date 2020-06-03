<?php

namespace App\Http\Middleware;

use App\Pages;
use App\Settings;
use Closure;
use Illuminate\Support\Facades\View;

class Share
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data['settings'] = Settings::all();
        foreach($data['settings'] as $key){
            $settings[$key->settings_key] = $key->settings_value;
        }        

        $page = Pages::all()->sortBy('page_must')->first();
        $settings['slug'] = $page['page_slug'];
        View::share($settings);

        return $next($request);
    }
}
