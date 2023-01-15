<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');
    }

    public function distance($lat,$long){
        $distance = 637100 * acos( cos( deg2rad(-8.2941) ) *
            cos( deg2rad( $lat ) )
            * cos( deg2rad( $long ) - deg2rad(114.3069)
            ) + sin( deg2rad($lat) ) *
            sin( deg2rad( -8.2941 ) ) );

        return $distance;

    }

    public function getpresence($lat, $long, $radius = 500)
        {
            /*
            using query builder approach, useful when you want to execute direct query
            replace 6371000 with 6371 for kilometer and 3956 for miles
            */
            // radius of bounding circle in kilometers
            $p = Presence::selectRaw("id, latitude,user_id,attendance_id, longitude,presence_date,presence_enter_time,presence_out_time,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS radius ", [$lat, $long, $lat])
            ->orderBy("presence_date",'desc')
            ->get();
            return $p;
        
        }
}
