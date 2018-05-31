@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create new post</div>
                <div class="panel-body">
					
					{!! Form::open(array('route'=>'posts.store')) !!}
						{{ Form::label('title', 'Title') }} <br>
						{{ Form::text('title', 'Unnamed Post',["class" => 'form-control']) }} <hr>
						
						{{ Form::label('content', 'Content') }} <br>
						{{ Form::textarea('content', null,["class" => 'form-control']) }}
						<hr>
						{{ Form::submit('Submit') }}
					{!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection