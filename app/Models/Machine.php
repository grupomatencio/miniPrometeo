<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'serie',
        'local_id',
        'bar_id',
        'alias',
        'identificador'
    ];

    /**
     * Relación con el modelo Local.
     */
    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    /**
     * Relación con el modelo Bar.
     */
    public function bar()
    {
        return $this->belongsTo(Bar::class);
    }

    public function delegation()
    {
        return $this->belongsTo(Delegation::class);
    }

   /* public function auxiliars()
    {
        return $this->hasMany(Auxiliar::class);
    }*/

    // Relación para el "padre" de la máquina
    public function parent()
    {
        return $this->belongsTo(Machine::class, 'parent_id');
    }

    // Relación para los "hijos" de una máquina
    public function children()
    {
        return $this->hasMany(Machine::class, 'parent_id');
    }

    // Método para verificar si es de tipo "parent"
    public function isParent()
    {
        return $this->type === 'parent';
    }

    // Método para verificar si es de tipo "roulette"
    public function isRoulette()
    {
        return $this->type === 'roulette';
    }

    // Método para obtener máquinas de tipo "parent" o "roulette"
    public static function getMachinesByType($type)
    {
        return self::where('type', $type)->get();
    }

    // Método para obtener los hijos de una máquina dependiendo de su tipo
    public function getChildrenByParentType()
    {
        if ($this->isParent()) {
            // Si la máquina es de tipo "parent", devuelve los hijos
            return $this->children; // Devuelve todos los hijos
        } elseif ($this->isRoulette()) {
            // Si la máquina es de tipo "roulette", devuelve los hijos
            return $this->children; // También puedes filtrar por otros criterios si es necesario
        }

        return collect(); // Si no es de tipo "parent" o "roulette", devuelve una colección vacía
    }

    // Método para obtener todos los hijos, sin importar el tipo
    public function getAllChildren()
    {
        return $this->children; // Devuelve todos los hijos sin importar el tipo
    }

    public function plate()
    {
        return $this->hasOne(Plate::class);
    }
}
