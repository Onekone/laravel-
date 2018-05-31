@extends('layouts.app')
@section('content')

<div class="container">
	
    <div class="row">
	
        <div class="col-md-10 col-md-offset-1">
		<?php if ($loggedIn) :?>
		<button onclick="window.location.href='{{route('posts.create')}}'" class='form-control'>Create new post</button>
		<?php endif; ?>
		<br>
			<?php foreach($posts as $post) {?>
            <div class="panel panel-default">
                <div class="panel-heading">
				{{ $post->title }} 
				</div>
                <div class="panel-body">
				{{ substr($post->content,0,150) }} {{strlen($post->content)>150 ? "..." : ""}} <hr>
						
						<div >
							<div style = "Text-align:left;Width:50%;float:left; width=50%; align=right">
							{{ date('M j, Y h:i', strtotime($post->created_at))}} {{ ($post->updated_at==$post->created_at) ? "" : " (edited)"}}
							</div>												
							
							<div style = "width:50%;Text-align:right;float:right;">
							{!! Form::model($post, ['route' => ['posts.destroy',$post->id], $post->id, 'method' => 'DELETE', 'name' => 'deleteForm'.$post->id]) !!}
							<a href = "{{route('posts.show', $post->id)}}"><img src="https://png.icons8.com/metro/1600/external-link.png" width=24px height=24px></a>	
							<?php if($loggedIn == $post->author) : ?>
								<a href = "{{route('posts.edit', $post->id)}}"><img src="https://image.flaticon.com/icons/svg/61/61456.svg" width=24px height=24px></a>
								<a href="#" onclick="document.deleteForm{{$post->id}}.submit();return false;"><img src="https://png.icons8.com/metro/1600/delete.png" width=24px height=24px></a>
							<?php endif; ?>	
							{!! Form::close() !!}
							</div>
						
						</div>
						
												
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
</div>
@endsection