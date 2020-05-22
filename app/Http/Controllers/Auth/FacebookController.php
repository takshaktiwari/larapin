<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use Exception;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $fb_user = Socialite::driver('facebook')->user();

            $create['name'] = $fb_user->getName();
            $create['email'] = $fb_user->getEmail();
            $create['facebook_id'] = $fb_user->getId();


            $user = User::where('facebook_id', $fb_user->getId())
                        ->orWhere('email', $fb_user->getEmail())->first();

            $object = ['name'   =>  $fb_user->getName(),
                        'email' =>  $fb_user->getEmail()];
            if (!empty($fb_user->avatar_original)) {
                if ($this->does_url_exists($fb_user->avatar_original)) {
                    copy($imag_url, storage_path('app/user/'.$fb_user->getId().'.jpg'));

                    $object = array_merge($object, ['user_img' => '/app/user/'.$fb_user->getId().'.jpg']);
                }
            }
            
            if ($user) {
                User::where('id', $user->id)
                        ->update($object);
            }else{
                $arr = ['password' => \Hash::make(time()),
                        'facebook_id'   =>  $fb_user->getId()];
                $object = array_merge($object, $arr);
                
                $user = User::create($object);
            }
       
            Auth::login($user);

            return redirect('user/home');


        } catch (Exception $e) {

            return redirect('auth/facebook');

        }
    }


    function does_url_exists($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }


}
