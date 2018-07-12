<?php

namespace App\GraphQL\Type\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class Authorization extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'Authorization',
		'description'		=> 'an authorization'
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	// protected $inputObject = true;

	public function fields()
	{
		return [
			'organization_id'=>	[
									'type' 			=> Type::string(),
									'description' 	=> 'The id of the user'
								],
			'scopes'		=> 	[
									'type' 			=> Type::listOf(Type::string()),
									'description' 	=> 'The name of the user'
								],
			'id'			=> 	[
									'type' 			=> Type::string(),
									'description' 	=> 'The active authorization start time'
								],
		];
	}

	protected function resolveIdField($root, $args)
	{
		return $root->uuid;
	}
}