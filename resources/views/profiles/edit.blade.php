@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your Profile </div>

                    <div class="panel-body">
                        {!! Form::model($profile, ['route'=>['profile.update'], 'files'=>true]) !!}

                        <div class="form-group">
                            {!! Form::label('avatar', 'Upload Avatar') !!}
                            {!! Form::file('avatar', null, ['class'=>'form-control', 'image/']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('location', 'Enter Location') !!}
                            {!! Form::text('location', null, ['class'=>'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('about', '') !!}
                            {!! Form::textarea('about', null, ['class'=>'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save Profile', ['class'=>'btn btn-lg btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
