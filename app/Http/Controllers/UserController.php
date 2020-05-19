<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getAllUsers()
    {
        return $this->userService->getAll();
    }
    public function deleteUserById($id)
    {
         $this->userService->deleteUser($id);
         return response() ->json(['message'=>'user deleted'],200);
    }
    public function register(Request $request)
    {
       /* if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response() ->json(['msg'=>'invalid email'],400);
        }*/
        if(User::where('email','=',$request->email)->first())
        {
            return response() ->json(['msg'=>' email exists'],400);
        }
        if (strlen($request->password) <= 4) {
            return response() ->json(['msg'=>'password must contain at least 4 characters'],400);
        }
        $response =  $this->userService->registerUser($request);

        return response() ->json($response,200);
    }
}
