<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class IUserOrganizationScope extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'IUserOrganizationScope',
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	protected $inputObject = true;

	public function fields()
	{
		return [
			'scope'			=> 	[
									'type' 			=> Type::string(),
									'rules'			=> ['nullable']
								],
		];
	}
}