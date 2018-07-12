<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class IUser extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'IUser',
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	protected $inputObject = true;

	public function fields()
	{
		return [
			'nama'			=> 	[
									'type' 			=> Type::string(),
									'rules'			=> ['nullable']
								],
			'username'		=> 	[
									'type' 			=> Type::string(),
									'rules'			=> ['required']
								],
			'password'		=> 	[
									'type' 			=> Type::string(),
									'rules'			=> ['string']
								],
		];
	}
}