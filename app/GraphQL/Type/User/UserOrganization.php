<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class UserOrganization extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'UserOrganization',
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	// protected $inputObject = true;

	public function fields()
	{
		return [
			'uuid'		=> 	[
									'name'			=> 'uuid',
									'type' 			=> Type::string(),
								],
			'nama'		=> 	[
									'name'			=> 'nama',
									'type' 			=> Type::string(),
								],
			'scopes'	=> 	[
									'name'			=> 'scopes',
									'type' 			=> Type::string(),
								],
		];
	}

	protected function resolveScopesField($root, $args)
	{
		return json_encode(array_column($root->getScopes($root->user_id)->toArray(), 'scope'));
	}
}