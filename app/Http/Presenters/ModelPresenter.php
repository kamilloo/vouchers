<?php

namespace App\Http\Presenters;

use App\Models\Model;

abstract class ModelPresenter
{
    /**
     * @var @mixin
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($name, $arguments)
    {
        return $this->model->{$name};
    }
}
