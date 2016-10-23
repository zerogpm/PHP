<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Datatables;
use DB;

class DatatablesController extends Controller
{
    public function getRooms()
    {
    	$rooms = \App\Room::all();

        if (\Auth::user()->hasRole('admin')) {
            return Datatables::of($rooms)
            ->addIndexColumn()
            ->addColumn('action', function ($room) {
                return '<a href="'. url('/dashboard/rooms/'.$room->id) .'" class="btn btn-xs btn-default">
                <i class="glyphicon glyphicon-search"></i> View</a>
                    <a href="'. url('/dashboard/rooms/' . $room->id . '/edit') .'" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button class="btn btn-xs btn-danger" data-name="'. $room->name .'" data-remote="'. url('/dashboard/rooms/' . $room->id) .'">
                    <i class="glyphicon glyphicon-trash"></i> Delete</button>';
            })
            ->make(true);
        } else {
            return Datatables::of($rooms)
        ->addIndexColumn()
        ->addColumn('action', function ($room) {
            return '<a href="'. url('/dashboard/rooms/'.$room->id) .'" class="btn btn-xs btn-default">
            <i class="glyphicon glyphicon-search"></i> View</a>';
        })
        ->make(true);
        }

    	
    }

    public function getUsers()
    {
        $users = \App\User::all();
        return Datatables::of($users)
        ->addIndexColumn()
        ->editColumn('created_at', function ($users) {
                return $users->created_at->format('j M Y, H:i');
        })
        ->addColumn('action', function ($user) {
            return '<a href="'. url('/dashboard/users/' . $user->id . '/edit') .'" class="btn btn-xs btn-primary">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>
            <button class="btn btn-xs btn-danger" data-name="'. $user->name .'" data-remote="'. url('/dashboard/users/' . $user->id) .'">
                <i class="glyphicon glyphicon-trash"></i> Delete</button>';
        })
        ->make(true);
    }

    public function getAllRoomBooking()
    {
        if (\Auth::user()->hasRole('admin')) {
            $booked = \App\Booking::with('room', 'user')
                        ->withTrashed()
                        ->orderBy('booking.start_date', 'desc')
                        ->get();
        } else {
            $booked = \App\Booking::with('room', 'user')
                        ->withTrashed()
                        ->where('user_id', \Auth::user()->id)
                        ->orderBy('start_date', 'desc')
                        ->get();
        }
        return Datatables::of($booked)
        ->addIndexColumn()
        ->editColumn('start_date', function ($booked) {
                return $booked->start_date->format('j M Y, H:i');
        })
        ->editColumn('end_date', function ($booked) {
                return $booked->end_date->format('j M Y, H:i');
        })
        ->addColumn('duration', function ($booked) {
            return $booked->duration;
        })
        ->addColumn('action', function ($booked) {
            if($booked->deleted_at == null && $booked->end_date > \Carbon\Carbon::now())
            {
                return '<button data-name="' . $booked->room->name .'" data-remote="'. url('/dashboard/booking/' . $booked->id) .'" data-method="DELETE" class="btn btn-xs btn-danger">
            <i class="glyphicon glyphicon-trash"></i> Cancel this?</a>';
            } elseif ($booked->deleted_at != null) {
                return '<span class="label label-success"> Cancelled</span>';
            } elseif ($booked->end_date < \Carbon\Carbon::now()) {
                return '<span class="label label-default"> Past</span>';
            }
            
        })
        ->make(true);
    }
}
