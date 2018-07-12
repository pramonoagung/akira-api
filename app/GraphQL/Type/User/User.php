<?php

namespace App\GraphQL\Type\User;

use \GraphQL\Type\Definition\Type;
use \Folklore\GraphQL\Support\Type as GraphQLType;
use Thunderlabid\Otorisasi\Models\Tenant;
use GraphQL;

class User extends GraphQLType
{
	protected $attributes = [
		'name'				=> 'User',
	];

	/*
	* Uncomment following line to make the type input object.
	* http://graphql.org/learn/schema/#input-types
	*/
	// protected $inputObject = true;

	public function fields()
	{
		return [
			'id'			=>	[ 'type' 			=> Type::string()					],
			'nama'			=> 	[ 'type' 			=> Type::string()					],
			'username'		=> 	[ 'type' 			=> Type::string()					],
			'organizations'	=> 	[ 'type' 			=> Type::listOf(GraphQL::type('UserOrganization'))	],
		];
	}

	protected function resolveIdField($root, $args)
	{
		return $root->username;
	}

	protected function resolveOrganizationsField($root, $args)
	{
		return $root->getTenants();
	}
}