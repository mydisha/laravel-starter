<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		\Illuminate\Auth\AuthenticationException::class,
		\Illuminate\Auth\Access\AuthorizationException::class,
		\Symfony\Component\HttpKernel\Exception\HttpException::class,
		\Illuminate\Database\Eloquent\ModelNotFoundException::class,
		\Illuminate\Session\TokenMismatchException::class,
		\Illuminate\Validation\ValidationException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	public function report(Exception $exception) {
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception) {
		if ($request->is('api/*')) {

			if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
				return $exception->getResponse();
			} else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
				$message = 'Error 404 Not Found';
			} else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
				$message = 'Method Not Allowed Exception';
			}

			$response = [];
			$response = [
				'error' => true,
				'message' => ($exception->getMessage() ? $exception->getMessage() : $message),
			];

			if (config('app.debug')) {
				$response['error_info'] = $exception->getTrace();
				$response['status_code'] = $exception->getCode();
			}

			$statusCode = method_exists($exception, 'getStatusCode')
			? $exception->getStatusCode()
			: 500;

			$response['status_code'] = $statusCode;

			Log::error(($exception->getMessage() ? $exception->getMessage() : $message));

			return response()->json($response);
		}

		return parent::render($request, $exception);
	}

	/**
	 * Convert an authentication exception into an unauthenticated response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Auth\AuthenticationException  $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception) {
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}

		return redirect()->guest(route('login'));
	}
}
