<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','lock'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function messages(){
        return $this->hasMany(Message::class,'id_receive','id')->groupBy('id_send')->orderBy('created_at','desc');
    }
    
    public function getDialog(){
        return $this->hasMany(Dialog::class,'user_id','id'); 
    }
    
    public function getNotReadDialog(){
        return $this->hasMany(Message::class,'id_receive','id')->where('read',NULL)->groupBy('dialog_id')->count();
    }
}
