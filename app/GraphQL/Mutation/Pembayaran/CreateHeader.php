<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
use App\Events\CheckVoucherEvent;
/**
 * User Query
 */
class CreateHeader extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateHeader'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('HeaderType'));
	}
	public function args()
	{
		return [
			'nomor' => ['name' => 'nomor', 'type' => Type::string()],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{

		HeaderTransaksi::create($args);

		return HeaderTransaksi::all();
	}
}