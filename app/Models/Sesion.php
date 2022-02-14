<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Activity;
use Carbon\Carbon;

class Sesion extends Model
{
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('created_at')
            ->as('reservations')
            ->withTimestamps();
    }

    use HasFactory;
    //lista de atributos "necesario" para rellenar al crear 
    //un objeto
    protected $fillable = ['date', 'hour_start', 'hour_end', 'activity_id', 'weekDay'];

    public function __toString()
    {
        return "" . $this->id;
    }
}
