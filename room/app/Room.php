<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Room extends Model
{ 
    
    protected $fillable = ['name', 'pax'];

	// return only available room based on start and end date
    public function scopeAvailable($query, $start, $end)
    {
    	// new booking clash in the middle of existing booking
		$bookedRoom = \DB::table('booking')
    					->select('room_id')
    					->where('start_date', '<=', $start)
    					->where('end_date', '>=', $end)
    					->orWhere(function($query) use ($start, $end){
    						$query->where('start_date', '>=', $start)
    							  ->where('end_date', '<=', $end)
                                  ->where('deleted_at', '=', null);
    					})
    					->orWhere(function($query) use ($start, $end){
    						$query->where('start_date', '>=', $start)
    							  ->where('end_date', '<=', $end)
                                  ->where('deleted_at', '=', null);
    					})
    					->orWhere(function($query) use ($start, $end){
    						$query->where('end_date', '>', $start)
    							  ->where('end_date', '<', $end)
                                  ->where('deleted_at', '=', null);
    					})
    					->orWhere(function($query) use ($start, $end){
    						$query->where('start_date', '<', $start)
    							  ->where('start_date', '>', $end)
                                  ->where('deleted_at', '=', null);
    					})
    					->distinct()
    					->get();

    	$roomId = [];

	    foreach($bookedRoom as $room)
	    {
	    	$roomId[] = $room->room_id;
	    }

		return $query->whereNotIn('id', $roomId);
    }

    // return all booked room
    public function scopeBooked($query)
    {
        $bookedRoom = \App\Booking::all();
        $roomId = [];

        foreach($bookedRoom as $room)
        {
            $roomId[] = $room->room_id;
        }
        return $query->whereIn('id', $roomId);
    }

}
