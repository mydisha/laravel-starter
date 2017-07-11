<?php

namespace App\Http\Traits;

trait ResponseTrait {
	public function response($error = false, $data, $message) {
		return response()->json([
			'error' => $error,
			'data' => $data,
			'message' => $message,
		]);
	}
}