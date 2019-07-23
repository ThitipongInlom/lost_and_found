<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\web_setting_model as web_setting_model;

class web_setting extends Controller
{
	public static function system_ver()
	{
        $ver = web_setting_model::where('setting_titel', 'system_ver')->value('setting_value');
        return $ver;
	}
}
