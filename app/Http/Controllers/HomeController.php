<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Message;
use App\Http\Requests\beforeSave;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index() {
        $user = new Message;

        return view('home', ['count' => $user->getNotReadMessages()]);
    }

    public function profile() {
        $user = User::find(\Auth::user()->id);
        return view('profile', ['user' => $user]);
    }

    public function save($id, beforeSave $request) {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        $user->save();

        flash('save');

        return redirect()->back();
    }
    
    public function refresh(){
        $count =  Message::where('id_receive',\Auth::user()->id)->where('read',NULL)->count();
        if ($count){
            return $count;
        }
    }

}
