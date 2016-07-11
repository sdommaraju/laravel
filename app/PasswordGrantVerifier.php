<?php
namespace App;

use Illuminate\Support\Facades\Auth;
use Adldap;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        
        //Verify $username against email_id or username
        if(!stristr($username,'@')){
            $username.=env('LDAP_EMAIL_SUFIX');
        }
        
        if(env('USER_AUTH_METHOD')=='ldap'){
            $credentials = [
                'email_id' => $username
            ];
            
            if (Adldap::getDefaultProvider()->auth()->attempt($username, $password)) {
            
                if (Auth::once($credentials)) {
                    return Auth::user()->id;
                }
            }
            
            
        } else {
            $credentials = [
                'email_id' => $username,
                'password' => $password
            ];
            
           
            if (Auth::once($credentials)) {
                return Auth::user()->id;
            }
        }
        
   
        
        return false;
    }
}