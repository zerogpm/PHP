<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    public function getEventsByRoomId($id)
    {
    	$user = \Auth::user();
    	if ($user->hasRole('admin'))
    	{
    		$events = \DB::table('booking')
	    			->join('rooms', 'booking.room_id', '=', 'rooms.id')
	    			->select(
	    				'booking.id',
	    				'booking.user_id',
	    				'booking.start_date as start',
	    				'booking.end_date as end',
	    				'rooms.name as room_name')
	    			->where('booking.room_id', $id)
	    			->where('booking.deleted_at',null)
	    			->get();
	    	foreach($events as $event)
	    	{
	    		if($event->user_id != $user->id)
	    		{
	    			$event->title = 'Booked by '. \App\User::find($event->user_id)->name;
	    			$event->color = '#cccccc';
	    		} else {
	    			$event->duration = \Carbon\Carbon::parse($event->end)
	    								->diffForHumans(\Carbon\Carbon::parse($event->start), true);
	    			$event->title = 'Booked for ' . $event->duration;
	    		}
	    	}
    	} else {
    		$events = \DB::table('booking')
	    			->join('rooms', 'booking.room_id', '=', 'rooms.id')
	    			->select(
	    				'booking.id',
	    				'booking.user_id',
	    				'booking.start_date as start',
	    				'booking.end_date as end',
	    				'rooms.name as room_name')
	    			->where('booking.room_id', $id)
	    			->where('booking.deleted_at',null)
	    			->get();
	    	foreach($events as $event)
	    	{
	    		if($event->user_id != $user->id)
	    		{
	    			$event->title = 'Booked by others';
	    			$event->color = '#cccccc';
	    		} else {
	    			$event->duration = \Carbon\Carbon::parse($event->end)
	    								->diffForHumans(\Carbon\Carbon::parse($event->start), true);
	    			$event->title = 'Booked for ' . $event->duration;
	    		}
	    	}
    	}
    	return $events;
    }
}
