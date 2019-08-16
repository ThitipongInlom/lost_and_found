<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    /*
        type V 0.1
    */    
    public $table = "type";
    /**
     * รายชื่อ ตาราง ใน ดาต้าเบส
     */
    protected $fillable = [
        'type_name', 
        'type_show', 
    ];

    public $timestamps = true;

     /**
     * ชื่อ ตาราง 
     */   
    protected $primaryKey = 'type_id';
}
