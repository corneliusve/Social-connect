@extends('layouts.app')

@section('content')


<div class="container"> 
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <p class="text-center">
                    <h3 class="text-center">{{ $user->name }}</h3>
                </p>
            </div>

            <div class="panel-body">

                <div class="profile-avatar" style="background-image: url({{ Storage::url($user->avatar) }});"></div>

                <p class="text-center">
                    {{ $user->profile->location }}
                </p>

                <p class="text-center">
                    @if(Auth::id() == $user->id)
                        <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info">Edit profile</a>
                    @endif
                </p>
            </div>

        </div>

        <div class="panel panel-default">

            <div class="panel-body">
                <div id="app">
                    <friend :profile_user_id="{{ $user->id }}"> </friend>
                </div>
            </div>

        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                <p class="text-center">
                    <h4 class="text-center">information</h4>
                </p>
            </div>

            <div class="panel-body">
                <p class="text-center">
                    {{ $user->profile->about }}
                </p>
            </div>

        </div>

        
    </div>
</div>
</div>
</div>


@endsection
