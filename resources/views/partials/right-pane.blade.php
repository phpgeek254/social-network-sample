@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">
                            {{ $user->name }}'s Profile
                        </p>
                    </div>
                    <div class="panel-body text-center">
                        <img src="{{ Storage::url($user->avatar) }}" width="70" height="70"  alt="{{  $user->name }}" style="border-radius: 50%">
                        <p class="text-center">
                            {{ $user->email }} <br>
                            {{ $user->profile->location }} <br>
                            @if( Auth::check() and Auth::id()  == $user->id)
                                <a class="btn btn-lg btn-info" href="{{ route('profile.edit') }}">
                                    Edit Your Profile
                                </a>
                            @endif
                        </p>

                    </div>
                </div>

                @if(Auth::check() and Auth::id() !== $user->id)
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <friend :profile_user_id="{{ $user->id }}"></friend>
                        </div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">
                            About Me.
                        </p>

                    </div>
                    <div class="panel-body text-center">
                        <p class="text-center">
                            {{ $user->profile->about }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
@endsection