<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class UserController extends Controller
{

    // Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

    public function store(Request $request)
    {
        
        $user = new User;
        $user ->email = $request ->email;
        $user ->password = Hash::make($request->password, ['rounds' => 13]);

        $user->save();

        return $user;
    }
    public function login (Request $request)
    {
        $user = DB::table ('users')->where('email',$request->email)->first();
        if ($user == null) {
            return response ('Email address or password does not match', 403);
    
        }
        if (Hash::check($request->password, $user->password)){
            
            return $user;
        }else {
            return response ('Email address or passowrd does not match',403);
        }
    }
}
