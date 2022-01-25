<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['name', 'description', 'duration', 'capacity'];

    public function __toString()
    {
        return "" . $this->id;
    }
}
