<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    // public function render($request, Throwable $exception): Response
    // {
    //     // You can log the exception or perform additional actions here if needed

    //     // Redirect all exceptions to a 404 page
    //     return response()->view('errors.404', [], 404);
    // }


    public function render($request, Throwable $exception): Response
{
    if (config('app.debug')) {
        // Return the detailed error message in debug mode
        return parent::render($request, $exception);
    }

    // Default behavior for production or non-debug mode
    return parent::render($request, $exception);
}

}
