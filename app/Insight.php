<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    protected $table = 'insights';

    protected $guarded = [];

    protected $primaryKey = 'in_id';

    protected $casts = [
        'in_data' => 'array',
    ];
}
