<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller
{
    protected $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->data = [
            'bodyClass' => 'hold-transition skin-blue sidebar-mini',
        ];
        $this->data['ajax'] = false;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pageTitle'] = config('app.name') . ' - Dashboard';
        if( \Auth::user()->hasRole('admin') )
        {
            // if admin, show active booking by all user
            $this->data['latestBooking'] = \App\Booking::where('end_date', '>', \Carbon\Carbon::now())
                                            ->orderBy('start_date', 'desc')
                                            ->get();
            $this->data['ajax'] = true;
        } else {
            
            // get logged user active booking only
            $this->data['latestBooking'] = \App\Booking::where('user_id', \Auth::user()->id)
                                            ->where('end_date', '>', \Carbon\Carbon::now())
                                            ->orderBy('start_date', 'desc')
                                            ->get();
            $this->data['ajax'] = true;
        }
        
        return view('dashboard.index', $this->data);
    }
}
