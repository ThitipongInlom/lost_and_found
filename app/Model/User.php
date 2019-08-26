<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /*
        user V 0.1
    */    
    public $table = "user";
    /**
     * รายชื่อ ตาราง ใน ดาต้าเบส
     */
    protected $fillable = [
        'username', 
        'fname',
        'lname',
        'phone',
        'email',
        'status',
        'lang',
        'place',
        'place_view',
        'ip_login',
    ];

    /**
     * รายชื่อ ตาราง ที่ซ่อน ใน ดาต้าเบส
     */    
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public $timestamps = true;

     /**
     * ชื่อ ตาราง 
     */   
    protected $primaryKey = 'user_id';
}
