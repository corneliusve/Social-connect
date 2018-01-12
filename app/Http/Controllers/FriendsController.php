<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FriendsController extends Controller
{
    public function check($id) 
    {
        if(Auth::user()->friend_with($id) === 1)
        {
            return ["status" => "friends"];
        }

        if(Auth::user()->has_request_from($id))
        {
            return ["status" => "pending"];
        }

        if(Auth::user()->has_request_to($id))
        {
            return ["status" => "waiting"];
        }
 
        return ["status" => 0];
    }

    public function add_friend($id)
    {
        Auth::user()->add_friend($id);
    }
}
