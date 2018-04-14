<?php

namespace Viperxes\Rest\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'amount'
    ];
}
