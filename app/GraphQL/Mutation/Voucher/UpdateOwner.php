<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
use Thunderlabid\Otorisasi\Models\User;
use App\Events\AddLogKepemilikanEvent;
/**
 * User Query
 */
class UpdateOwner extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateOwner'
	];
	public function type()
	{
		return GraphQL::type('VoucherType');
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'username' => ['name' => 'username', 'type' => Type::string()],
		];
	}
	public function resolve($root, $args)
	{

		$event = event(new AddLogKepemilikanEvent($args['username'],$args['id']));
		$user = User::where('username',$args['username'])->first();
		// dd($user);

		if($user){
			$data = Voucher::find($args['id']);

			$data->owner_id = $user->id;
			
	        $data->save();

		return $data;	
		}else
		{
			dd('username not exist');
		}
		
	}
}