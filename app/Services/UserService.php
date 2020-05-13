<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
       return User::all();
    }
    public function deleteUser($id)
    {
        return User::where('user_id','=',$id)
            ->delete();
    }

    public function registerUser(Request $request)
    {
        $user = new User();
        $user->email=$request['email'];
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            return response() ->json(['msg'=>'invalid email']);
        }
        if(User::where('email','=',$user->email)->first())
        {
            return response() ->json(['msg'=>' email exists'],400);
        }
        $user->first_name=$request['first_name'];
        $user->last_name=$request['last_name'];
        $user->password=$request['password'];
        if (strlen($user->password) <= 8) {
            return response() ->json(['msg'=>'password must contain at least 8 characters']);
        }
        $user->save();
        return $user;
    }

}
