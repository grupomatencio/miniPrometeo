<?php

namespace App\Models;

use App\Models\Money\CollectDetails;
use Database\Seeders\UsersTicketServerSeedeer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_zone',
        'ip_address',
        'port',
        'idMachine'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    /*public function auxiliares()
    {
        return $this->hasMany(Auxiliar::class, 'local_id');
    }*/

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }


}
