<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public static function findByDate($date)
    {
        $sesions = Sesion::all();
        $id = "";
        foreach ($sesions as $sesion) {
            ($sesion->date_start == $date) ? $id = $sesion->id : false;
        }
        return Sesion::find($id);
    }

    public static function destroyIfDayNotExists($id, $weekDaysSelected)
    {
        $sesion = Sesion::find($id);
        $sesionCarbonDate = Carbon::parse($sesion->date_start);
        foreach ($weekDaysSelected as $weekDay) {
            ($weekDay != $sesionCarbonDate->englishDayOfWeek) ? Sesion::destroy($sesion) : false;
        }
    }
}
