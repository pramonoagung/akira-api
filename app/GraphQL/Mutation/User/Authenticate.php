<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use DB;

use GraphQL\Type\Definition\Type;
use GraphQL\Error\Error;

use Folklore\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;

use Thunderlabid\Otorisasi\Models\User;

use Firebase\JWT\JWT;

class Authenticate extends Mutation
{
	protected $attributes = [
		'name' => 'Authenticate'
	];

	public function type()
	{
		return GraphQL::type('Login');
	}

	public function authorize($root, $args)
	{
		return true;
	}

	public function authenticated($root, $args, $context)
	{
		return true;
	}

	public function args()
	{
		return [
			'input'			=> 	[
									'name' 	=> 'input', 		
									'type' 	=> GraphQL::type('InputLogin'),
									'rules' => ['required'],
								],
		];
	}

	public function resolve($root, $args)
	{
		//////////////
		// Retrieve //
		//////////////
		$user = User::username($args['input']['username'])->first();

		//////////////////
		// Authenticate //
		//////////////////
		if (!$user)
		{
			throw new \Exception("Invalid authentication", 1000);
		}

		if (!app('hash')->check($args['input']['password'], $user->password))
		{
			throw new \Exception("Invalid authentication", 1000);
		}

		//save device FCM reg id
		isset($args['input']['fcm_token'])? $this->setFcmId($user->id,$args['input']['fcm_token']):'';

		// Create JWT
		$jwt_key 	= env("JWT_KEY");
		$token 		= [
						'iss'		=> env('JWT_ISS'),
						'aud'		=> env('JWT_AUD'),
						'iat'		=> \Carbon\Carbon::now()->timestamp,
						'exp'		=> \Carbon\Carbon::now()->addMinutes(env('JWT_EXP_MIN', 30))->timestamp,
						'user_id'	=> $user->username,
					  ];
		$jwt_token = JWT::encode($token, $jwt_key);

		// Return
		return 	[
					'token' => $jwt_token,
					'user' 	=> $user,
				];
	}

	private function setFcmId($userId, $fcmToken){
		$deviceReg = User::find($userId);
		$deviceReg->device_reg_id = $fcmToken;
		$deviceReg->save();
	}
}