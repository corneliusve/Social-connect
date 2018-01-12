<?php

namespace App\Traits;

use App\Friendship;

trait Friendable 
{

    public function add_friend($requested_id)
    {

        if($this->id === $requested_id)
        {
            return 0;
        }

        if($this->has_request_to($requested_id) === 1)
        {
            return "already send friend request";
        }

        if($this->has_request_from($requested_id) === 1)
        {
            return $this->accept_friend($requested_id);
        }

        if($this->friend_with($requested_id) === 1)
        {
            return "your are already friends";
        }
        
        $friendship = Friendship::create([
            'requester' => $this->id,
            'requested' => $requested_id
        ]);

        if($friendship) 
        {
            return 1;
        } 

        return 0;
        

    }


    public function accept_friend($requester)
    {

        if($this->has_request_from($requester) === 0)
        {
            return 0;
        }

        $friendship = Friendship::where('requester', $requester)->where('requested', $this->id)->first();
        

        if($friendship)
        {
            $friendship->update([
                'status' => 1
            ]);

            return 1;
        } 

        return 0;
        
    }

    public function friend()
    {
        $friends = array();

        $f1 = Friendship::where('status', 1)->where('requester', $this->id)->get();

        foreach( $f1 as $friendship ):
            array_push($friends, \App\User::find($friendship->requested));
        endforeach;

        $friends2 = array();

        $f2 = Friendship::where('status', 1)->where('requested', $this->id)->get();

        foreach( $f2 as $friendship ):
            array_push($friends2, \App\User::find($friendship->requester));
        endforeach;

        return array_merge($friends, $friends2);
    }

    public function friend_requests()
    {
        $friend_requests = array();

        $friendships = Friendship::where('status', 0)->where('requested', $this->id)->get();

        foreach( $friendships as $friendship ):

            array_push($friend_requests, \App\User::find($friendship->requester));

        endforeach;

        return $friend_requests;
    }

    public function friend_ids()
    {
        return collect($this->friend())->pluck('id')->toArray();
    }


    public function friend_with($user_id)
    {

        if(in_array($user_id, $this->friend_ids()))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function requests_ids()
    {
        return collect($this->friend_requests())->pluck('id')->toArray();
    }

    public function friend_requested()
    {
        $friend_requested = array();

        $friendships = Friendship::where('status', 0)->where('requester', $this->id)->get();

        foreach( $friendships as $friendship ):

            array_push($friend_requested, \App\User::find($friendship->requested));

        endforeach;

        return $friend_requested;
    }

    public function requested_ids()
    {
        return collect($this->friend_requested())->pluck('id')->toArray();
    }


	public function has_request_from($user_id)
	{
		if(in_array($user_id, $this->requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function has_request_to($user_id)
	{
		if(in_array($user_id, $this->requested_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


}