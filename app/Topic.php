<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $guarded = [];

    protected $primaryKey = 'tid';
}
