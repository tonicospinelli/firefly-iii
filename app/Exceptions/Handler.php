<?php
declare(strict_types = 1);
namespace FireflyIII\Exceptions;

use Auth;
use ErrorException;
use Exception;
use FireflyIII\Jobs\MailError;
use FireflyIII\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 *
 * @package FireflyIII\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport
        = [
            AuthorizationException::class,
            HttpException::class,
            ModelNotFoundException::class,
        ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof FireflyException || $exception instanceof ErrorException) {

            $isDebug = env('APP_DEBUG', false);

            return response()->view('errors.FireflyException', ['exception' => $exception, 'debug' => $isDebug], 500);
        }

        return parent::render($request, $exception);
    }


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {

        if ($exception instanceof FireflyException || $exception instanceof ErrorException) {

            $user = Auth::check() ? Auth::user() : new User;

            $data = [
                'class'        => get_class($exception),
                'errorMessage' => $exception->getMessage(),
                'time'         => date('r'),
                'stackTrace'   => $exception->getTraceAsString(),
                'file'         => $exception->getFile(),
                'line'         => $exception->getLine(),
                'code'         => $exception->getCode(),
            ];

            // create job that will mail.
            $job = new MailError($user, env('SITE_OWNER'), Request::ip(), $data);
            dispatch($job);
        }

        parent::report($exception);
    }
}
