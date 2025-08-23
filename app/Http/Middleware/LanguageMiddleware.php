<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App;
use App\Models\Language;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define the path where you want to enforce English
        $adminDashboardPath = 'admin/dashboard';

        // Get the current path from the request
        $currentPath = $request->path();

        // Check if the current path matches the admin dashboard path
        if ($currentPath === $adminDashboardPath) {
            // Set language to English for this path
            $englishLanguage = Language::where('code', 'en')->first(); // Assuming 'en' is the code for English

            if ($englishLanguage) {
                App::setLocale($englishLanguage->code); // Set locale to English
                session(['sess_lang_name' => $englishLanguage->name]);
                session(['sess_lang_code' => $englishLanguage->code]);
                session(['sess_lang_direction' => 'LTR']); // Set text direction to LTR
            }
        } else {
            // Check if there is any session data for language, if not set the default language
            if (session('sess_lang_code') === null) {
                $default_language = Language::where('default', 1)->first();
                if ($default_language) {
                    session(['sess_lang_name' => $default_language->name]);
                    session(['sess_lang_code' => $default_language->code]);
                    session(['sess_lang_direction' => $default_language->direction]);
                }
            }

            // Set the application language based on the session data
            App::setLocale(session('sess_lang_code'));
        }

        return $next($request);
    }
}
