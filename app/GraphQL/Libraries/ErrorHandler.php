<?php

namespace App\GraphQL\Libraries;

use GraphQL\Error\Error;
use Folklore\GraphQL\Error\ValidationError;
use Folklore\GraphQL\Error\AuthorizationError;
use Illuminate\Auth\AuthenticationException;


class ErrorHandler {

	public static function formatError(Error $e)
	{
		$error = [
			'message' 	=> $e->getMessage(),
		];

		$locations = $e->getLocations();
		if (!empty($locations)) {
			$error['locations'] = array_map(function ($loc) {
				return $loc->toArray();
			}, $locations);
		}

		$previous = $e->getPrevious();
		if ($previous && $previous instanceof ValidationError) {
			$error['validation'] = $previous->getValidatorMessages();
		} elseif ($previous && $previous instanceof \Illuminate\Validation\ValidationException) {
			$error['message']	 = 'validation';
			$error['validation'] = $previous->errors();
		} elseif ($previous && $previous instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
			$error['message']	 = 'Resource not found';
			$error['validation'] = "ID " . is_array($previous->getIds()) ? implode(', ',$previous->getIds()) : $previous->getIds() . " not found";
			$error['code'] 		= 404;
		} elseif ($previous && $previous instanceof AuthorizationError) {
			$error['message']	 = 'Unauthorized Access';
		} elseif ($previous && $previous instanceof \Exception) {
			throw $previous;
			$error['message'] = $previous->getMessage();
			$error['code'] = $previous->getCode();
		} elseif ($previous && !$previous instanceof Error) {
			throw $previous;
		}

		return $error;
	}
}