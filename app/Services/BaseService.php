<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class BaseService
{

    /** @var $model Model */
    protected $model;

    /** @var Builder $query */
    protected $query;

    public $className;


    public function __construct()
    {
        $this->setModel();
        $this->setQuery();
        $this->setClassName();
    }

    /**
     * @return mixed
     */
    abstract protected function setModel();

    /**
     *
     */
    private function setQuery()
    {
        $this->query = $this->model::query();
    }

    public function show($id)
    {
        return $this->query->find($id);
    }

    private function setClassName()
    {
        $this->className = get_class($this->model);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function store($input)
    {
        $save = $this->model->fill($input)->save();
        return $this->res($save, __('validation.models.'.$this->className).__('message.common.create_success'));
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function update($input, $id)
    {
        $data = $this->query->find($id);
        if (!$data) {
            return $this->res(
                $data,
                str_replace(
                    ':model',
                    __('validation.models.'.$this->className),
                    __('message.common.not_exists')
                )
            );
        }
        $save = $data->fill($input)->save();
        return $this->res($save, __('validation.models.'.$this->className).__('message.common.update_success'));
    }

    public function res($data, $message = null)
    {
        $message = $message ? $message : __('message.common.exception');
        return $data ? ['message' => $message] : ['errors' => $message];
    }
}
