<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dologin(Request $r)
    {
      $authadmin = [
        'email' => $r->email,
        'password' => $r->password,
        'id_role' => 1
      ];

      $authuser = [
        'email' => $r->email,
        'password' => $r->password,
        'id_role' => 2
      ];

      if(\Auth::attempt($authadmin))
      {
        return redirect()->route('myshop-dashboard');
      }
      else if(\Auth::attempt($authuser))
      {
        return redirect()->to('/');
      }
      else {
        return redirect()->back()->withErrors('Username or Password Incorrect');
      }
    }

    public function logout()
    {
      \Auth::logout();
      return redirect()->to('/');
    }

    public function dologincart(Request $r)
    {

        $authadmin = [
          'email' => $r->email,
          'password' => $r->password,
          'id_role' => 1
        ];

        $authuser = [
          'email' => $r->email,
          'password' => $r->password,
          'id_role' => 2
        ];

        if(\Auth::attempt($authadmin))
        {
          return redirect()->back();
        }
        else if(\Auth::attempt($authuser))
        {
          return redirect()->back();
        }
        else {
          return redirect()->back()->withErrors('Username or Password Incorrect');
        }
      }

      public function register(Request $r)
      {
        if(\App\User::where('email',$r->email)->first())
        {
          return redirect()->back()->with('failed-register','email '.$r->email.' was already registered');
        }
        else {
          $user = new \App\User;
          $user->email = $r->email;
          $user->password = bcrypt($r->password);
          $user->full_name = $r->fullname;
          $user->phone = $r->phone;
          $user->id_role = 2;
          $user->save();

          \Auth::attempt(['email' => $r->email, 'password' => $r->password]);

          return redirect()->to('/')->with('success-register','set');
        }
      }

}
