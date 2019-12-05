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
        'place',
        'img_1',
        'img_2',
        'img_3',
        'return_item',
        'name_item_out',
        'dep_item_out',
        'type_item_out',
        'date_item_out',
        'name_return_guest',
        'address_return_guest',
        'date_return_guest',
        'phone_return_guest',
        'dep_return_guest',
        'ems_return_guest',
        'other_return_guest'
    ];

     /**
     * ชื่อ ตาราง 
     */   
    protected $primaryKey = 'list_id';
}
