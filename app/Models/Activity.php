<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sesion;

class Activity extends Model
{
    public function sesions()
    {
        return $this->hasMany(Sesion::class);
    }

    use HasFactory;

    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['name', 'description', 'duration', 'capacity'];

    public function __toString()
    {
        return "" . $this->id;
    }

    public function users(){
        $total = 0;
        foreach($this->sesions as $sesion){
            $total += count($sesion->users);
        }
        return $total;
    }
    
}
