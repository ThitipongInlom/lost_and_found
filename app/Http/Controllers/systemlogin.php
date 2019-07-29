<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Model\User as User;
use Session;

class systemlogin extends Controller
{
    public function login_page(Request $request)
    {
        return view('auth/login');
    }

    public function do_login(Request $request)
    {
        // เช็คว่า มี Username ถูกต้องหรือไม่
        if (Auth::attempt(['username' => $request->post('username'), 'password' => $request->post('password')])) {
            // อัพเดต ข้อมูลเวลา Login เสร็จสิ้น
            $User = User::find(Auth::User()->user_id);
            $User->updated_at = Carbon::now();
            $User->remember_token = $request->header('X-CSRF-TOKEN');
            $User->ip_login = $request->ip();
            $User->save();
            
            // Success Login สำเร็จ
            return response()->json(['status' => 'success','error_text' =>  trans('login.login_success') ,'path' => $request->root()],200);
        }else{
            // Error Login ไม่สำเร็จ
            return response()->json(['status' => 'error','error_text' =>  trans('login.login_error') ],200);
        }
    }

    public function register_page(Request $request)
    {
        return view('auth/register');
    }

    public function do_register(Request $request)
    {
        $username = User::where('username', $request->post('username'))->count();
        if ($username == '0') {

                $User = new User;
                $User->username = $request->post('username');
                $User->password = Hash::make($request->post('password'));
                $User->fname = $request->post('fname');
                $User->lname = $request->post('lname');
                $User->phone = $request->post('phone');
                $User->email = $request->post('email');
                $User->status = 'user';
                $User->remember_token = $request->header('X-CSRF-TOKEN');
                // ยืนยันการ Insert ลง DB
                $User->save();

            return response()->json(['status' => 'success','error_text' => 'สมัครสมาชิก สำเร็จ กรุณารอซักครู่','path' => $request->root()],200);
        }else {
            return response()->json(['status' => 'error','error_text' => 'ชื่อ มีอยู่ในระบบแล้ว กรุณาเปลี่ยน ชื่อผู้ใช้งาน'],200);    
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function switch_lang(Request $request)
    {
        $lang = $request->get('lang');
        Session::put('locale', $lang);
    }
    
}
