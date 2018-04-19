<?php

namespace Viperxes\Rest\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
use Viperxes\Rest\Repositories\Contracts\ {
    FilterInterface, RepositoryFilterInterface, RepositoryInterface
};
use Viperxes\Rest\Repositories\Exceptions\RepositoryException;

abstract class Repository implements RepositoryInterface, RepositoryFilterInterface
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var bool
     */
    protected $skipFilter = false;

    /**
     * @param Application $app
     * @throws RepositoryException
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param FilterInterface $filter
     * @param array $data
     * @return $this
     */
    public function getByFilter(FilterInterface $filter, $data = [])
    {
        if ($this->skipFilter === true) {
            return $this;
        }

        $this->model = $filter->apply($this->model, $this, $data);

        return $this;
    }

    /**
     * Skip Filter
     *
     * @param bool $status
     * @return $this
     */
    public function skipFilter($status = true)
    {
        $this->skipFilter = $status;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }
}
