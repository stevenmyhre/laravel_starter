<?php
use App\Http\JsonMetaResponse;

if ( ! function_exists('jSuccess')) {

    function jSuccess($data = null)
    {
        return JsonMetaResponse::success($data);
    }

}

if ( ! function_exists('jError')) {

    function jError($errors, $data = null)
    {
        return JsonMetaResponse::error($errors, $data);
    }
}