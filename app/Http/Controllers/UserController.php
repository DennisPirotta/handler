<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return view('users.index',[
            'user' => User::find(auth()->id())
        ]);
    }

    public function updateIcon(Request $request,User $user){
        $user->avatar = $request['icon'];
        $user->save();
        return back();
    }
}
