<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\AnswerRequest;
use App\User;
use App\Dialog;
use App\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessagesController extends Controller {

    public function create() {
        $user = User::where('id', '!=', \Auth::user()->id)->where('lock', NULL)->get();
        return view('message', ['users' => $user]);
    }

    public function send(MessageRequest $request) {
        $message = new Message;

        $message->id_send = \Auth::user()->id;
        $message->dialog_id = \Auth::user()->id + $request->name;
        $message->id_receive = $request->name;
        $message->message = $request->message;

        $message->save();

        $dialog = new Dialog;

        if (!$dialog->checkDialog(\Auth::user()->id, $request->name)) {
            $dialog->createDialog(\Auth::user()->id, $request->name);
            $dialog->createDialog(\Auth::user()->id, $request->name, true);
        }
        flash('message send');

        return redirect()->back();
    }

    public function dialog() {
        $user = User::find(\Auth::user()->id);

        return view('list_dialog', ['users' => $user]);
    }

    public function show($id) {
        (new Message)->readOpenMessage($id);

        $messages = Message::where('dialog_id',$id)->orderBy('created_at','desc')->get();
        
        $user_id = Dialog::where('total',$id)->where('user_id','!=',\Auth::user()->id)->first()->user_id;

        $sender = User::find($user_id);
        return view('show', ['messages' => $messages,'sender' => $sender,'id' => $id]);
    }
    
    public function answer(AnswerRequest $request, $id){
       
        (new Message)->create([
            'id_send' => \Auth::user()->id,
            'id_receive' => $request->sender_id,
            'dialog_id' => \Auth::user()->id + $request->sender_id,
            'message' => $request->message,
        ]);
        
        
        flash('message send');
        return redirect()->back();
    }

}
