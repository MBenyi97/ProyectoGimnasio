<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['user_id', 'sesion_id', 'date'];

    public function __toString()
    {
        return "" . $this->id;
    }
}
