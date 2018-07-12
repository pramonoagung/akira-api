<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class IUserOrganization extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'IUserOrganization',
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
			'uuid'			=> 	[
									'type' 			=> Type::string(),
									'rules'			=> ['nullable']
								],
		];
	}
}