<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

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
}
