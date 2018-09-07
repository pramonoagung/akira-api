<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class InputLogin extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'InputLogin',
		'description'		=> 'Login Input'
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	protected $inputObject = true;

	public function fields()
	{
		return [
			'username'		=> 	[
									'name' 	=> 'username', 		
									'type' 	=> Type::string(),
									'rules' => ['required', 'string'],
								],
			'password'		=> 	[
									'name' 	=> 'password', 		
									'type' 	=> Type::string(),
									'rules' => ['required', 'string'],
								],
			'fcm_token'		=> 	[
									'name' 	=> 'fcm_token', 		
									'type' 	=> Type::string()
								],
		];
	}
}