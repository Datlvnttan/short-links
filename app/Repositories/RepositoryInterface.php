<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Get one
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * Create
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete
     * @param $id     
     * @return mixed
     */
    public function delete($id);

     /**
     * Deletes
     * @param array $list_id
     * @return mixed
     */
    public function deletes($list_id);

    /**
     * findBy
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     * getPaginated
     * @param mixed $perPage
     * @param array $columns
     * @return mixed
     */
    public function getPaginated(?int $perPage, mixed $columns = ['*']);

  /**
     * where        
     * @return mixed
     */
    public function where($field,$operator , $value);

    public function sum(string $field);
    public function join($table,$field1,$operator, $field2);
    public function leftJoin($table,$field1,$operator, $field2);
    public function rightJoin($table,$field1,$operator, $field2);
}
