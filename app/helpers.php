<?php

function flash($messages) {
    session()->flash('flash_messages', $messages);
}

function getDialogName($dialog_id) {
    $id = App\Dialog::where('total', $dialog_id)->where('user_id', '!=', \Auth::user()->id)->first()->user_id;

    $user = App\User::find($id);
    return $user->name;
}
