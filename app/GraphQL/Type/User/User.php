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
			'voucher' => [
				'args' => [
					'id' =>[
						'type' => Type::string(),
						'description' => 'Header id',
					],
				],

				'type' => GraphQL::type('VoucherType'),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->voucherlist->where('voucher',$args['id']);
					}
					return $root->voucherlist;
				}
			],
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