<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['date_start', 'date_end'];

    public function __toString()
    {
        return "" . $this->id;
    }

    // public function __call($method, $arguments)
    // {
    //     if (method_exists($this, $method)) {
    //         $this->$method = $this->$method();
    //         return $this->$method;
    //     }
    // }

}
