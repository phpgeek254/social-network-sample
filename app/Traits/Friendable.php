<?php

namespace App\Traits;
use App\Friendship;
use App\User;

trait Friendable {

	public  function  add_friend( $user_requested_id )
	{
	    if ( $this->id === $user_requested_id ){
	        return 0;
        }

        if($this->has_pending_friend_request_sent_to($user_requested_id))
        {
            return 'Friend request already sent';
        }

        if ( $this->has_pending_friend_request_from($user_requested_id))
        {
            $this->accept_friendship($user_requested_id);
        }
		$friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id
        ]);

		if( $friendship ) {
		    return 1;
        }

        return 0;
	}

	public function accept_friend($requester) {

	    if ($this->has_pending_friend_request_from($requester) === 0){
	        return 0;
        }

	    $friendship = Friendship::where('requester', $requester)
            ->where('user_requested', $this->id)
            ->first();

	    if($friendship) {
	        $friendship->update(['status'=> 1]);
	        return 1;
        }

        return 0;
    }

    public function friends()
    {
        $friends = [];
        $friends_you_requested = Friendship::where('status', 1)
            ->where('requester', $this->id)
            ->get();

        foreach ($friends_you_requested as $friend):
            $friends[] = User::find($friend->user_requested);
        endforeach;

        $friends2 = [];
        $friends_who_requested = Friendship::where('status', 1)
            ->where('user_requested', $this->id)->get();

        foreach ($friends_who_requested as $friend):
            $friends2[] = User::find($friend->requester);
        endforeach;

        return array_merge($friends, $friends2);

    }

    public function pending_friend_requests()
    {
        $users = [];

        $friendships = Friendship::where('status', 0)
            ->where('user_requested', $this->id)->get();
        foreach ($friendships as $f):
            $users[] = User::find($f->requester);
        endforeach;
        return $users;
    }

    public function friends_ids()
    {
        return collect($this->friends())->pluck('id');
    }

    public function is_friends_with($user_id)
    {
        if (in_array($user_id, $this->friends_ids()->toArray())) {
            return 1;
        }
    }

    public  function  pending_friend_request_ids()
    {
        return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }

    public function pending_friend_requests_sent()
    {
        $users = [];

        $requests = Friendship::where('status', 0)
            ->where('requester', $this->id)->get();
        foreach ( $requests as $request):
            $users[] = User::find($request->user_requested);
        endforeach;

        return $users;
    }

    public function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)
    {
        if (in_array($user_id, $this->pending_friend_request_ids())){
            return 1;
        } else {
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids())){
            return 1;
        } else {
            return 0;
        }
    }


}