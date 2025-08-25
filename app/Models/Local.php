<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'local';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
    ];
}
