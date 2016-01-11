<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $fillable = [
        'id_send', 'id_receive', 'message','read','created_at', 'dialog_id'
    ];
    
    public function getSenderName(){
        return $this->belongsTo(User::class,'id_send','id');
    }
    
    public function getDialog(){
        return $this->hasMany(Dialog::class,'dialog_id','id'); 
    }
    
    public function readOpenMessage($id){
        return $this->where('dialog_id',$id)->where('read',NULL)->where('id_receive',\Auth::user()->id)->update(['read' => 1]);
    }
    
    public function getNotReadMessages(){
        return $this->where('id_receive',\Auth::user()->id)->where('read',NULL)->count();
    }
    public function getNotReadMessagesById($id){
        $count = $this->where('id_receive',\Auth::user()->id)->where('read',NULL)->where('dialog_id',$id)->count();
        if ($count)
        return '('.$count.')';
    }
}
