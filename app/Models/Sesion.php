<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['fechaSesion', 'horaInicio', 'horaFinal'];

    public function __toString()
    {
        return "" . $this->id;
    }
}
