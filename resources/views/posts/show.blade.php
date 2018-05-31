@extends('layouts.app')

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
				<table width=100%>
					<tr>
						<td align="left">{{ $post->title }} </td>
						{!! Form::model($post, ['route' => ['posts.destroy',$post->id], $post->id, 'method' => 'DELETE', 'name' => 'deleteForm']) !!}
						<td align="right">{{$post->created_at}} 
						<?php if($sameAuthorAsUser) : ?>
							-
							<a href = "{{route('posts.edit', $post->id)}}"><img src="https://image.flaticon.com/icons/svg/61/61456.svg" width=24px height=24px></a> - 
							
							<a href="#" onclick="document.deleteForm.submit();return false;"><img src="https://png.icons8.com/metro/1600/delete.png" width=24px height=24px></a>
							
							
						<?php endif; ?>
						{!! Form::close() !!}
						</td>
						
					</tr>
				</table>
				</div>

                <div class="panel-body">
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection
