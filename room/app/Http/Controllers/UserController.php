<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class UserController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'bodyClass' => 'hold-transition skin-blue sidebar-mini',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403, 'Unauthorized action.');
        }
        $this->data['pageTitle'] = config('app.name') . ' - User Management';
        $this->data['ajax'] = true;
        return view('dashboard.user-index', $this->data);
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
            abort(403, 'Unauthorized action.');
        }
        $this->data['pageTitle'] = config('app.name') . ' - User Management';
        return view('dashboard.user-create', $this->data);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(! \Auth::user()->hasRole('admin'))
        {
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [ 
            'name'      => 'required',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6|max:15',
        ]);

        User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'verified'  => true,
        ]);

        return redirect('/dashboard/users')->with('status', 'User successfully created!');
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
            abort(403, 'Unauthorized action.');
        }
        $this->data['pageTitle'] = config('app.name') . ' - User Management';
        $this->data['user']      = User::findOrFail($id);
        return view('dashboard.user-edit', $this->data);  
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
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [ 
            'name'      => 'required',
            'email'     => 'required|email|max:255|unique:users,email,' . $id,
            'password'  => 'min:6|max:15',
        ]);

        // check if password is set, update password too
        if($request->input('password'))
        {
            User::where('id', $id)->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => $request->input('password')
            ]);
        } else {
            User::where('id', $id)->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
            ]);
        }
        
        return back()->with('status', 'User successfully updated!');
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
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);

        if(\Auth::user()->id != $id)
        {
            $user->delete();
            return response()->json(['status'=>true]);
        } else {
            return response()->json(['status'=>false ,'message' => 'Error: You cannot delete yourself!']);
        }
    }
}
