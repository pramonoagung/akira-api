<?php

namespace Thunderlabid\Otorisasi\Models\Observers;

///////////////
// Framework //
///////////////
use Validator;
use Illuminate\Validation\Rule;

////////////
// Models //
////////////
use Illuminate\Database\Eloquent\Model;

class Validate { 

	public function saving(Model $model)
	{
		$rules = $model->rules;

		////////////////////
		// Process Unique //
		////////////////////
		foreach ($rules as $k => $v)
		{
			foreach ($v as $k2 => $v2)
			{
				switch ($v2) {
					case 'unique':
						$rules[$k][$k2] = Rule::unique($model->getTable())->ignore($model->id);
						break;
				}
			}
		}

		//////////////
		// Validate //
		//////////////
		Validator::make($model->makeVisible($model->getHidden())->toArray(), $rules)->validate();
	}
}