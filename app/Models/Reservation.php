<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sesion;
use App\Models\Activity;

class Reservation extends Model
{
    use HasFactory;

    public static function getActivityName(Reservation $reservation)
    {
        $sesions = Sesion::all();
        foreach ($sesions as $sesion) {
            ($sesion->id == $reservation->sesion_id) ? $sesionId = $sesion : false;
        }
        $activities = Activity::all();
        foreach ($activities as $activity) {
            ($activity->id) == $sesionId->activity_id ? $activityName = $activity->name : false;
        }
        return $activityName;
    }

    public static function getActivityId(Reservation $reservation)
    {
        $sesions = Sesion::all();
        foreach ($sesions as $sesion) {
            ($sesion->id == $reservation->sesion_id) ? $sesionId = $sesion : false;
        }
        $activities = Activity::all();
        foreach ($activities as $activity) {
            ($activity->id) == $sesionId->activity_id ? $activityId = $activity->id : false;
        }
        return $activityId;
    }

    public static function getSesionDates(Reservation $reservation)
    {
        $sesions = Sesion::all();
        $dates = [
            'sesion_id' => '',
            'date_start' => '',
            'date_end' => ''
        ];
        foreach ($sesions as $sesion) {
            if ($sesion->id == $reservation->sesion_id) {
                $dates['sesion_id'] = $sesion->id;
                $dates['date_start'] = $sesion->date_start;
                $dates['date_end'] = $sesion->date_end;
            }
        }
        return $dates;
    }
}
