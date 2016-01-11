<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dialog;
use App\Message;
use Mail;
use App\Http\Requests\beforeSave;
use App\Http\Requests\BeforeCreate;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

    public function index() {
        $users = User::where('role_id', '=', NULL)->get();

        return view('admin.home', [
            'users' => $users
        ]);
    }

    public function edit($id) {
        $user = User::find($id);

        return view('admin.edit', [
            'user' => $user
        ]);
    }

    public function save($id, beforeSave $request) {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->lock = $request->lock;

        if ($request->regenerate) {
            $password = str_random(10);
            $user->password = \Hash::make($password);

            \Mail::send('emails.password', ['password' => $password], function ($message) use ($user) {
                $message->from('test@app.com', 'Your Application');

                $message->to($user->email, $user->name)->subject('Password has been changed!');
            });
        }

        $user->save();

        flash('save');

        return redirect()->back();
    }

    public function delete($id) {
        User::find($id)->delete();
    }

    public function add() {
        return view('admin.create');
    }

    public function create(BeforeCreate $request) {
        $password = str_random(10);
        $user = (new User)->create([
            'name' => $request->name,
            'email' => $request->email,
            'lock' => $request->lock,
            'password' => \Hash::make($password)
        ]);

        flash('new user created!!');

        \Mail::send('emails.new_user', ['password' => $password, 'name' => $request->name], function ($message) use ($user) {
            $message->from('test@app.com', 'Your Application');

            $message->to($user->email, $user->name)->subject('User created!');
        });

        return redirect('admin/user/' . $user->id);
    }

}
