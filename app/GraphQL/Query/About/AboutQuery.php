<?php 
namespace App\GraphQL\Query\About;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\About\Models\About;
/**
 * User Query
 */
class AboutQuery extends Query
{
	
	protected $attributes = [
		'name' => 'AboutQuery'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('AboutType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'nama' => ['name' => 'nama', 'type' => Type::string()],
			'alamat' => ['name' => 'alamat', 'type' => Type::string()],
			'kontak' => ['name' => 'kontak', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return About::where('id', $args['id'])->get();
		}elseif(isset($args['nama'])){
			return About::where('nama', $args['nama'])->get();
		}elseif(isset($args['alamat'])){
			return About::where('alamat', $args['alamat'])->get();
		}elseif(isset($args['kontak'])){
			return About::where('kontak', $args['kontak'])->get();
		}else{
			return About::all();
		}
	}

}