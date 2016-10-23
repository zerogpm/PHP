<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Room;

class RoomController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'bodyClass' => 'hold-transition skin-blue sidebar-mini',
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
        $this->data['pageTitle'] = config('app.name') . ' - Room Management';
        $this->data['ajax'] = true;
        return view('dashboard.room-index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403);
        }
        $this->data['pageTitle'] = config('app.name') . ' - Add new room';
        return view('dashboard.room-create', $this->data);
    }

    /**
     * Show the selected resource
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['pageTitle'] = config('app.name') . ' - Add new room';
        $this->data['room'] = Room::findOrFail($id);
        return view('dashboard.room-show', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:rooms|min:3|max:150',
            'pax' => 'required|integer'
        ]);

        \App\Room::create([
            'name' => $request->input('name'),
            'pax' => $request->input('pax')
        ]);

        return redirect('/dashboard/rooms')->with('status','Room saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403);
        }
        $this->data['room'] = Room::findOrFail($id);
        return view('dashboard/room-edit', $this->data);
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
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403);
        }

        $this->validate($request,[
            'name' => 'required|unique:rooms,name,'.$id.'|min:3|max:150',
            'pax' => 'required|integer'
        ]);

        $room = Room::find($id);
        $room->name = $request->input('name');
        $room->pax = $request->input('pax');
        $room->save();
        return back()->with('status', 'Successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403);
        }
        $room = Room::findOrFail($id);
        $room->delete();
        return response()->json(true);
    }

}
