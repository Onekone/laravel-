@extends('layouts.app')

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			{!! Form::model($post, ['route' => ['posts.update',$post->id], $post->id, 'method' => 'PUT', 'name' => 'editForm']) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
				<table width=100%>
					<tr>
						<td align="left" >{{ Form::text('title', null,["class" => 'form-control']) }} </td>
						<td align="right">{{$post->created_at}} 
						<?php if($sameAuthorAsUser) : ?>
							<a href = "{{route('posts.show', $post->id)}}"><img src="https://png.icons8.com/metro/1600/delete-sign.png" width=24px height=24px></a> - 
							<a href="#" onclick="document.editForm.submit();return false; "><img src="https://image.flaticon.com/icons/svg/61/61456.svg" width=24px height=24px></a>							
						<?php endif; ?>
						
						</td>
						
					</tr>
				</table>
				</div>

                <div class="panel-body">
				{{ Form::textarea('content',null,["class" => 'form-control']) }}				
                </div>
            </div>
			{!! Form::close() !!}
        </div>
    </div>
</div>	
@endsection
