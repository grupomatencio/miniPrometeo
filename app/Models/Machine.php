<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fallable = [
        'name', 'alias', 'local_id', 'bar_id', 'delegation_id', 'identificador'
    ];
}
