<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Booking;

class BookingController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'bodyClass' => 'hold-transition skin-blue sidebar-mini',
            'pageTitle' => config('app.name') . ' - Booking Management',
            'menu' => 3
        ];
        $this->data['ajax'] = false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.booking-index', $this->data);
    }

    /**
     * This is for ajax request - Search for available room.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'pax'               => 'required',
            'reservationTime'   => 'required|duration'
        ]);

        $dates   = explode(' - ', $request->input('reservationTime'));
        $start = $this->change_date_format($dates[0]);
        $end = $this->change_date_format($dates[1]);

        $data = [
            'rooms' => \App\Room::Available($start, $end)->where('pax', $request->input('pax'))->get(),
            'reservationTime' => $request->input('reservationTime')
        ];
        return view('dashboard.booking-search-result', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['ajax'] = true;
        return view('dashboard.booking-create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'room'              => 'required',
            'reservationTime'   => 'required'
        ]);

        // change format date
        $dates   = explode(' - ', $request->input('reservationTime'));
        $start = $this->change_date_format($dates[0]);
        $end = $this->change_date_format($dates[1]);

        Booking::create([
            'user_id'       => \Auth::user()->id,
            'room_id'       => $request->input('room'),
            'start_date'    => $start,
            'end_date'      => $end
        ]);

        return back()->with('status', 'Booking successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::destroy($id);
        return back()->with('status', 'Successfully deleted!');
    }

    public function change_date_format($date)
    {
        $time = \DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }
}
