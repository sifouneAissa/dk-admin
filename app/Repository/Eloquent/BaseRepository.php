<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository constructor.
	 *
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * @param array $attributes
	 *
	 * @return Model
	 */
	public function create(array $attributes): Model
	{
		return $this->model->create($attributes);
	}

    public function response($data)
	{
        return response()->json($data);
	}

	/**
	 * @param $id
	 * @return Model
	 */
	public function find($id): ?Model
	{
		return $this->model->find($id);
	}

	public function perPage(){
		
		if(request()->has('per_page') && request()->per_page){
			return request()->per_page;
		}

		return config('app.perpage');
	}

	public function toSqlWithBindings($eloquent)
	{
		return vsprintf(
			str_replace('?', '%s', $eloquent->toSql()),
			collect($eloquent->getBindings())
				->map(function ($binding) {
					return is_numeric($binding) ? $binding : "'{$binding}'";
				})
				->toArray()
		);
	}
}
