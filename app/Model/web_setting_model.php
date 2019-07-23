<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class web_setting_model extends Model
{
    /*
        type V 0.1
    */    
    public $table = "web_setting";
    /**
     * รายชื่อ ตาราง ใน ดาต้าเบส
     */
    protected $fillable = [
        'setting_titel',
        'setting_value', 
    ];

    public $timestamps = false;

     /**
     * ชื่อ ตาราง 
     */   
    protected $primaryKey = 'setting_id';
}
