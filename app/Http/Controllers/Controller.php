<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Input;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected function nullifyEmpties(array $arr)
	{
		return array_map(function($n) {
			return strlen($n) > 0 ? $n : null;
		}, $arr);
	}

	protected function allInput($except = array())
	{
		return Input::except(
			array_merge(array(
				'_token'
			), $except));
	}

}
