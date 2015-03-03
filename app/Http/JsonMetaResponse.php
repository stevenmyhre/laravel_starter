<?php namespace App\Http;

use Illuminate\Http\JsonResponse;

class JsonMetaResponse extends JsonResponse {

    public function __construct($model, $status = 200)
    {
        parent::__construct($model, $status);
    }

    public static function error($errors, $data = null)
    {
        return new self(static::getModel(false, $errors, $data), 500);
    }

    public static function success($data = null)
    {
        return new self(static::getModel(true, null, $data));
    }

    public static function redirect($url, $data = null)
    {
        return new self(static::getModel(true, null, $data, $url));
    }

    private static function getModel($success = true, $errors = array(), $data = null, $redirect_url = null)
    {
        if(!is_array($errors))
            $errors = array($errors);
        return array(
            'success' => $success,
            'errors' => $errors,
            'message' => count($errors) == 1 ? $errors[0] : "Multiple errors have occurred when processing the request",
            'data' => $data,
            'redirect' => $redirect_url,
        );
    }
} 