<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use DB;
use Gate;
use Auth;
use Exception;

use GraphQL\Type\Definition\Type;
use GraphQL\Error\Error;

use Folklore\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;

use Thunderlabid\Otorisasi\Models\User;

class StoreUser extends Mutation
{
	protected $attributes = [
		'name' => 'StoreUser'
	];

	public function type()
	{
        return GraphQL::type('User');
	}

	public function authorize($root, $args)
	{
		return true;
	}

	public function authenticated($root, $args, $context)
	{
		return !is_null(Auth::User()->id);
	}

	public function args()
	{
		return [
			'input'				=> 	[
										'name' 	=> 'input', 		
										'type' 	=> GraphQL::type('IUser'),
									],
			'addUser'			=> 	[
										'type'	=> Type::listOf(GraphQL::type('IUser')),
										'rules'	=> ['nullable']
									],
			'removeOrganization'=> 	[
										'type'	=> Type::listOf(Type::String()),
										'rules'	=> ['nullable']
									],
			'addOrganization'	=> 	[
										'type'	=> Type::listOf(GraphQL::type('IUserOrganization')),
										'rules'	=> ['nullable']
									],
			'addScope'			=> 	[
										'type'	=> Type::listOf(GraphQL::type('IUserOrganizationScope')),
										'rules'	=> ['nullable']
									],
			'removeScope'		=> 	[
										'type'	=> Type::listOf(GraphQL::type('IUserOrganizationScope')),
										'rules'	=> ['nullable']
									]
		];
	}

	public function resolve($root, $args)
	{
		//////////////
		// Policies //
		//////////////

		////////
		// Do //
		////////
		DB::beginTransaction();

		// Edit Event
		$user 	= User::username($args['input']['username'])->first();

		if (isset($args['input']))
		{
			$user->edit($args['input']);
		}


		DB::Commit();
		
		return $user;
	}
	
}