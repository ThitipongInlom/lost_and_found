<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class list_item extends Model
{
    /*
        type V 0.1
    */    
    public $table = "list_item";
    /**
     * รายชื่อ ตาราง ใน ดาต้าเบส
     */
    protected $fillable = [
        'place_found',
        'item_type', 
        'item_detail', 
        'date_found',
        'guest_name',
        'check_in_date',
        'check_out_date',
        'found_by',
        'locate_track',
        'record_by',
        'img_1',
        'img_2',
        'img_3',
        'return_item',
    ];

    public $timestamps = false;

     /**
     * ชื่อ ตาราง 
     */   
    protected $primaryKey = 'list_id';
}
