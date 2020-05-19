<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role','description','titre','prenom','created_at','updated_at','etat_compte','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getRole(){
        return $this->role;
    }

    public function getEtat(){
        return $this->etat_compte;
    }

    public function getHashedPass(){
        return $this->password;
    }
    public function setPassword($unHashedPass){
        $this->password = Hash::make($unHashedPass);
        $this->save();
    }
}
