<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleSign extends Model
{
    protected $table = 'google_signs';

    protected $guarded = [];

    protected $primaryKey = 'id';
}
