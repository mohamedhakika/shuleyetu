<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserResetPassword;
use App\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    /**
    * Constructor to initialize object
    *
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangePasswordRequest $request, $id)
    {
        $current_password = Auth::User()->password;
        if(Hash::check($request['old_password'], $current_password))
        {
          $user_id = Auth::User()->id;
          $obj_user = User::find($user_id);
          $obj_user->password = Hash::make($request['password']);
          $obj_user->update();
          Auth::logout();
          return redirect()->route('login')->with('success', 'Password changed successfully, please login with new password');
        }else{
          $errors = array('old_password' => 'Current password is incorect');
          return redirect()
                      ->back()->withInput($request->input())
                    ->withErrors($errors);
        }
    }

    /**
     * Reset password of student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function password_reset($id)
     {
         $user = User::find($id);
         if(!$user){
             \App::abort('409');
         } 
         return view('profile.reset_password',compact('user'));
     }
 
     /**
      * Reset password of student.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function passwordReset(UserResetPassword $request, $id)
     {
         $user = User::find($id);
         if(!$user){
             \App::abort('409');
         }
         $password = Hash::make($request->get('password'));
         $user->update([
             'password' => $password,
         ]);
         return redirect()->route('user.reset.password',$id)
            ->with('flash','User password reset successfully');
     }
 

}
