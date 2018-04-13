@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Notifications</div>

                    <div class="panel-body">
                    <ul class="list-group">
                        @foreach( $notes as $note )
                            <li class="list-group-item">
                                <strong> {{ $note->data['name'] }} </strong>
                                <span class="pull-right"> {{ $note->created_at->diffForHumans() }}</span>
                                <br>
                                {{ $note->data['message'] }}
                            </li>
                        @endforeach
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
