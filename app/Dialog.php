<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model {

    protected $fillable = [
        'user_id', 'total'
    ];
    protected $table = 'dialog';

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getMessages() {
        return $this->belongsTo(Message::class, 'total', 'dialog_id')->orderBy('created_at', 'desc');
    }

    public function createDialog($send_id, $res_id, $revers = false) {
        if ($revers) {
            $this->create([
                'user_id' => $send_id,
                'total' => $send_id + $res_id
            ]);
        } else {
            $this->create([
                'user_id' => $res_id,
                'total' => $send_id + $res_id
            ]);
        }
    }
    
    public function checkDialog($send_id, $res_id){
        $flight = $this->where('user_id', $send_id)->where('total',$send_id + $res_id)->first();
        if ($flight){
            return true;
        }else{
            return false;
        }
    }
    
//    public function count(){
//        return $this->
//    }

}
