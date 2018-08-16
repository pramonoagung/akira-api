<?php 
namespace App\GraphQL\Mutation\About;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\About\Models\About;
/**
 * User Query
 */
class UpdateAbout extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateAbout'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('AboutType'));
	}
	public function args()
	{
		return [
			'nama' => ['name' => 'nama', 'type' => Type::string()],
			'alamat' => ['name' => 'alamat', 'type' => Type::string()],
			'kontak' => ['name' => 'kontak', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = About::find($args['id']);

		$data->nama = $args['nama'];
		$data->alamat = $args['alamat'];
		$data->kontak = $args['kontak'];

        $data->save();

		return About::all();
	}
}