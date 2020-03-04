<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Collection;

class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @param $id
     * @return Model[]|Collection|\Illuminate\Database\Eloquent\Model|null
     */
    protected static function find($id)
    {
        return static::all()->find($id);
    }
}