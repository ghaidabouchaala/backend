<?php

namespace App\Http\Controllers;

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
        $response =  $this->userService->registerUser($request);
        return response() ->json($response);
    }
}
