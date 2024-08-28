<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements RepositoryInterface {
    protected $model;

    public function __construct() {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function all($columns = ['*']) {
        return $this->model->get($columns);
    }

    public function find($id, $columns = ['*']) {
        return $this->model->find($id, $columns);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $record = $this->model->find($id);
        if (!$record) {
            return false;
        }
        return $record->update($data);
    }
    public function delete($id) {
        return $this->model->find($id)->delete();        
    }

    public function deletes($list_id) {
        foreach ($list_id as $id) 
            $this->delete($id);                             
    }

    public function findBy($field, $value, $columns = ['*']) {
        return $this->model->where($field, $value)->get($columns);
    }
    public function getPaginated(?int $perPage, mixed $columns = ['*'])
    {
        $perPage = $perPage ?? intval(config("setting.PER_PAGE"),10);        
        return $this->model::select($columns)->paginate($perPage);
    }
    public function where($field,$operator,$value)
    {
        return $this->model->where($field, $operator, $value);
    }
    public function sum(string $field)
    {
        return $this->model->sum($field);
    }
    public function join($table,$field1,$operator , $field2)
    {
        return $this->model->join($table, $field1, $operator, $field2);
    }
    public function leftJoin($table,$field1,$operator , $field2)
    {
        return $this->model->leftJoin($table, $field1, $operator, $field2);
    }
    public function rightJoin($table,$field1,$operator , $field2)
    {
        return $this->model->rightJoin($table, $field1, $operator, $field2);
    }
}
