<?php


namespace App\Models;


class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @param $id
     * @return Model[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    protected static function find($id)
    {
        return static::all()->find($id);
    }
}