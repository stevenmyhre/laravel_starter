<?php namespace App\Exceptions;

use App\Http\JsonMetaResponse;
use App\PERS\Util\PersException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        if ($e instanceof PersException)
        {
            if($request->isJson())
            {
                return JsonMetaResponse::error(array($e->getMessage()));
            } else {
                return $this->renderPlain($request, $e);
            }
        }
		if ($this->isHttpException($e))
		{
			return $this->renderHttpException($e);
		}
		else
		{
            if(config('app.debug') && $request->isJson() || env("APP_ENV") == 'testing') {
                return $this->renderPlain($request, $e);
            }
			return parent::render($request, $e);
		}
	}

    private function renderPlain($request, $e)
    {
        if (!$e instanceof FlattenException)
            $ex = FlattenException::create($e);
        else
            $ex = $e;
        return response($ex->getClass() . "\n" . $ex->getMessage() . "\n\n" . $e->getTraceAsString(), $ex->getStatusCode());
    }

}
