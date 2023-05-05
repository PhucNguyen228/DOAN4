<?php

namespace App\Http\Controllers;

use App\Models\DanhMucSanPham;
use App\Models\Google;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Facades\Toastr;

class GoogleController extends Controller
{
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        // $sanPham = SanPham::all();
        // $danhMuc = DanhMucSanPham::where('yeu_cau', 1)->get();
        $google = Socialite::driver('google')->user();
        // dd($google);

        // Check if there is an existing user with this email
        $authUser = TaiKhoan::where('email', $google->email)->first();

        if ($authUser) {
            // Log the user in
            // dd($authUser);
            // Auth::login($authUser, true);
            Auth::guard('TaiKhoan')->login($authUser);
            // Toastr()->success('đăng nhập thành công');

        } else {
            // Create a new user
            $user = new TaiKhoan();
            $user->ten_tai_khoan = $google->name;
            $user->muc = 1;
            $user->email = $google->email;
            $user->password = bcrypt($user->name);
            $user->sdt = '';
            $user->dia_chi = '';
            $user->is_email = 1;
            $user->trang_thai = 1;
            $user->hash = Str::uuid();
            $user->save();

            // Log the user in
            Auth::guard('TaiKhoan')->login($user);
        }

        // return view('customer.home_page.index',compact('sanPham','danhMuc'));
        return redirect('/');
    }
    // public function findOrCreateUser($users, $provider)
    // {
        // $authUser = Google::where('provider_user_id', $users->id)->first();
        // if ($authUser) {
        //     return $authUser;
        // } else {

        //     $hieu = new Google([
        //         'provider_user_id' => $users->id,
        //         'provider' => strtoupper($provider)
        //     ]);

        //     $orang = TaiKhoan::where('email', $users->email)->first();

        //     if (!$orang) {
        //         $orang = TaiKhoan::create([
        //             'ten_tai_khoan' => $users->name,
        //             'muc'           => 1,
        //             'email'         => $users->email,
        //             'password'      => '',
        //             'sdt'           => '',
        //             'dia_chi'       => '',
        //             'is_email'      => 1,
        //             'trang_thai'    => 1,
        //             'hash'          => '',
        //         ]);
        //     }
        //     $hieu->login()->associate($orang);
        //     $hieu->save();

        //     // $account_name = TaiKhoan::where('id',$users->id)->first();
        //     // Session::put('ten_tai_khoan',$account_name->ten_tai_khoan);
        //     // Session::put('id',$account_name->id);
        //     // $user_id = TaiKhoan::find($$orang);
        //     Auth::login($hieu);
        //     return redirect('/')->with('message', 'Đăng nhập Admin thành công');

    // }




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
// }
