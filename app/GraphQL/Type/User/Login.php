<?php

namespace App\GraphQL\Type\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class Login extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'Login',
		'description'		=> ''
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	// protected $inputObject = true;

	public function fields()
	{
		return [
			'token'			=>	[
									'type' 			=> Type::string(),
									'description' 	=> 'auth token'
								],
			'user'			=> 	[
									'type' 			=> GraphQL::Type('User'),
									'description' 	=> 'User data'
								],
		];
	}
}