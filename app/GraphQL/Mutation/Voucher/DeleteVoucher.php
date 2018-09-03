<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
use Illuminate\Support\Facades\DB;
/**
* User Query
*/
class DeleteVoucher extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteVoucher'
	];
	public function type()
	{
		return GraphQL::type('VoucherType');
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$voucher = Voucher::findOrFail($args['id']);
		try{
			DB::BeginTransaction();
			$voucher->delete();
			DB::Commit(); 
			return $voucher;
		}catch(Exception $e){
			DB::Rollback();
		}
	}
}