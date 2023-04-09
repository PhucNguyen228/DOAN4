<?php

namespace App\Http\Controllers;


use App\Models\Google;
use App\Models\TaiKhoan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->user();
        // dd($users);
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = TaiKhoan::where('id',$authUser->user)->first();
        Session::put('ten_tai_khoan',$account_name->ten_tai_khoan);
        Session::put('id',$account_name->id);
        return redirect('/')->with('message', 'Đăng nhập Admin thành công');

    }
    public function findOrCreateUser($users,$provider){
        $authUser = Google::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{

        $hieu = new Google([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = TaiKhoan::where('email',$users->email)->first();

            if(!$orang){
                $orang = TaiKhoan::create([
                    'ten_tai_khoan' => $users->name,
                    'muc'           => 1,
                    'email'         => $users->email,
                    'password'      => '',
                    'sdt'           => '',
                    'dia_chi'       => '',
                    'is_email'      => 1,
                    'trang_thai'    => 1,
                    'hash'          => '',
                ]);
            }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = TaiKhoan::where('id',$authUser->user)->first();
        Session::put('ten_tai_khoan',$account_name->ten_tai_khoan);
        Session::put('id',$account_name->id);
        // $user_id = TaiKhoan::find($$orang);
        // Auth::login(TaiKhoan::find($user_id),true);
        return redirect('/')->with('message', 'Đăng nhập Admin thành công');

        }
    }




    // public function callback_google(){
    //     $provider = Socialite::driver('google')->user();
    //     $account = Google::where('provider','google')->where('provider_user_id',$provider->getId())->first();
    //     if($account){
    //         //login in vao trang quan tri
    //         $account_name = TaiKhoan::where('id',$account->user)->first();
    //         Session::put('ten_tai_khoan',$account_name->ten_tai_khoan);
    //         Session::put('id',$account_name->id);
    //         return redirect('/')->with('message', 'Đăng nhập Admin thành công');
    //     }else{
    //         $hieu = new Google([
    //                     'provider_user_id' => $provider->getId(),
    //                     'provider' => 'google'
    //                 ]);
    //         $orang = TaiKhoan::where('email',$provider->email)->first();

    //         if(!$orang){
    //             $orang = TaiKhoan::create([
    //                 'ten_tai_khoan' => $provider->name,
    //                 'muc'           => 1,
    //                 'email'         => $provider->email,
    //                 'password'      => '',
    //                 'sdt'           => '',
    //                 'dia_chi'       => '',
    //                 'is_email'      => 1,
    //                 'trang_thai'    => 1,
    //                 'hash'          => '',
    //             ]);
    //         }
    //         $hieu->login()->associate($orang);
    //         $hieu->save();

    //     $account_name = TaiKhoan::where('id',$account->user)->first();
    //     Session::put('ten_tai_khoan',$account_name->ten_tai_khoan);
    //     Session::put('id',$account_name->id);
    //     // $user_id = TaiKhoan::find($$orang);
    //     // Auth::login(TaiKhoan::find($user_id),true);
    //     return redirect('/')->with('message', 'Đăng nhập Admin thành công');
    //     }
    // }




    // public function callback_google(){
    //     $user = Socialite::driver('google')->user();
    //     $this->registerOrLoginUser($user);
    //     return redirect('/');
    // }

    // public function registerOrLoginUser($data){
    //     $user = TaiKhoan::where('email', '=' , $data->email)->first();
    //     if(!$user){
    //         $user = new TaiKhoan();
    //         $user->ten_tai_khoan = 'tran kim that';
    //         $user->muc           = 1;
    //         $user->email         = $data->email;
    //         $user->password      = '';
    //         $user->sdt           = '';
    //         $user->dia_chi       = '';
    //         $user->trang_thai    = 1;
    //         $user->hash          = '';
    //         $user->save();
    //     }

    //     Auth::login($user);
    // }
}
