<?php

namespace Thunderlabid\Otorisasi;
use DB;

abstract class BaseAggregate
{
	protected $data;

	public function edit($attr)
	{
		/*
			Edit
		 */
		$this->data->fill($attr);

		/*
			Save
		 */
		DB::beginTransaction();
		$this->data->save();
		DB::commit();
	}

	public function delete()
	{
		/*
			Edit
		 */
		DB::beginTransaction();
		$this->data->delete();
		DB::commit();
	}

	public function restore()
	{
		/*
			Restore
		 */
		DB::beginTransaction();
		$data->restore();
		DB::commit();
	}

	public function __get($field)
	{
		if ($field == 'data') { return $this->data; }
		if ($field == 'model') { return $this->model->newInstance(); }
	}
}