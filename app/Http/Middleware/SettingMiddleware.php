<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $settings = Setting::get();

        $categories = Category::where('status', '1')->with('subCategory')->withCount('products')->get();

        view()->share(['settings' => $settings, 'categories'=>$categories]);
        return $next($request);
    }
}
