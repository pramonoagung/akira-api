<?php

namespace App\GraphQL\Query\User;

use GraphQL;
use Auth;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query as BaseQuery;
use App\Application\Models\User;

class Query extends BaseQuery
{
	public function authorize($root, $args)
	{
		return true;
	}

	public function authenticated($root, $args, $context)
	{
		return !is_null(Auth::User()->id);
	}

	public function type()
	{
		return Type::listOf(Type::String());
	}

	public function resolve($root, $args)
	{
		return User::ROLES;
	}
}

