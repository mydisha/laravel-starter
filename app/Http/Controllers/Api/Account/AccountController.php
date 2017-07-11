<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 *
 * @author Dias Taufik Rahman
 * @copyright 2017
 *
 */
class AccountController extends Controller {
	use Responsetrait;

	/**
	 * Login Method using JWT
	 *
	 * @var Object $accountInfo
	 * @var Array $credentials
	 * @throws JWTException
	 * @return Json Response
	 */
	public function login() {
		$credentials = request()->only(['email', 'password']);

		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return $this->response(true, null, 'Email / Password Salah!');
			} else {
				$accountInfo = Auth::user();
				$accountInfo->token = $token;
				Log::alert($accountInfo->name . ', Logged in from Api Endpoint');
				return $this->response(false, $accountInfo, 'Login Berhasil');
			}
		} catch (JWTException $e) {
			return $this->response(true, null, $e->getMessage());
		}
	}
}
