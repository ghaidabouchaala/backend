<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTAuth;

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
        $user->first_name=$request['first_name'];
        $user->last_name=$request['last_name'];
        $user->password=bcrypt($request['password']);
        $user->save();
        return $user;
    }
    public function retrieveUserFromToken()
    {
        try {
            return auth()->user();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $refreshed = JWTAuth::refresh(JWTAuth::getToken());
            $user = JWTAuth::setToken($refreshed)->toUser();
            header('Authorization: Bearer ' . $refreshed);
            return $user;
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return null;
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return null;
        }
    }
}
