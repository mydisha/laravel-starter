<?php

namespace App;

use App\Http\Traits\ModelTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements AuthenticatableUserContract {
	use Notifiable, EntrustUserTrait, ModelTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims() {
		return [
			'user' => [
				'id' => $this->id,
			],
		];
	}
}
