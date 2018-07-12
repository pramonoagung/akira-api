<?php

namespace Thunderlabid\Otorisasi\Models\Observers;

////////////
// Models //
////////////
use Illuminate\Database\Eloquent\Model;

class GenerateUUID { 

	public function saving(Model $model)
	{
		if ($model->uuid) return;
			
		if (function_exists('com_create_guid') === true) 
		{
			$model->uuid = trim(com_create_guid(), '{}');
		}

		do { 
			$uuid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		} while ($model->newQuery()->withTrashed()->uuid($uuid)->first());

		$model->uuid = $uuid;
	}
}