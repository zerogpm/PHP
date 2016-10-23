<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

class ChangePasswordController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'bodyClass' => 'hold-transition skin-blue sidebar-mini',
        ];
    }

    public function index()
    {
    	$this->data['pageTitle'] = config('app.name') . ' - User Settings';
    	return view('auth.change-password', $this->data);
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
        $this->validate($request,[
            'current_password'	=> 'required|current_password:'. $request->user()->password,
            'password' 			=> 'required|min:6|max:15|confirmed'
        ]);

        $user = \App\User::find($id);
        $user->password = bcrypt($request->input('password'));
    	$user->save();
    	return back()->with('status', 'Successfully changed!');
    }

}
