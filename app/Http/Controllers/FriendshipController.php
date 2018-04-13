<?php

namespace App\Http\Controllers;

use App\Notifications\AcceptFriendRequest;
use App\Notifications\AddFriend;
use App\Notifications\NewFriendRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function name(){
        
    }

    public function check($id)
    {
        if(Auth::user()->is_friends_with($id))
        {
            return ['status' => 'friends'];
        }
        if(Auth::user()->has_pending_friend_request_from($id)){
            return ['status'=>'pending'];
        }
        if(Auth::user()->has_pending_friend_request_sent_to($id))
        {
            return ['status'=>'waiting'];
        }
        return ['status'=>0];
    }

    public function add_friend($id)
    {
        //Send Notifications, Broadcasting and emails
        $response = Auth::user()->add_friend($id);
        User::find($id)->notify(new NewFriendRequest(Auth::user()));
         return $response;
    }

    public function accept_friend($id)
    {
        // Send notifications and emails.
        $response =  Auth::user()->accept_friend($id);
        User::find($id)->notify(new AcceptFriendRequest(Auth::user()));
        return $response;
    }

    public function get_friend_requests()
    {
       return Auth::user()->pending_friend_requests();
    }
}
