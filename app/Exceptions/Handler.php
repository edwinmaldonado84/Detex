<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }



    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'No tienes permisos para esta acción.',
                ]
            ], 403));
        }


        if ($exception instanceof ModelNotFoundException) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'No se encontraron datos necesarios para ejecutar esta tarea.',
                ]
            ], 404));
        }



        if ($exception instanceof ValidationException) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }


        return parent::render($request, $exception);
    }
}
