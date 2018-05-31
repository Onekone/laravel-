<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Article;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // receive everything
		$posts = Article::all();
		
		$user = Auth::user();
		$loggedIn = false;
		if ($user)
		{
			$loggedIn = $user->id;
		}
		
		// view
		return view('posts.index')->with("loggedIn",$loggedIn)->with("posts",$posts);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
		$this->validate($request,array(
			'title' => 'required|max:255','content' => 'required'
		));
		
		// store 
		$post = new Article;
		$post->title = $request->title;
		$post->content = $request->content;
		
		$user = Auth::user();
	
		if ($user)
		{
			$post->author = $user->id;
			$post->save();
		}
		else
		{
			return redirect()->route('posts.index');
		}
		return redirect()->route('posts.show',$post->id);
		// redirect
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$post = Article::find($id);
		
		$user = Auth::user();
		if ($user)
			$sameAuthorAsUser = ($user->id == $post->author);
		else
			$sameAuthorAsUser = false;
		
        return view('posts.show')->with('post',$post)->with('sameAuthorAsUser',$sameAuthorAsUser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Article::find($id);
		
		$user = Auth::user();
		if ($user) 
		{
			$sameAuthorAsUser = ($user->id == $post->author);
			if (!$sameAuthorAsUser)
				return redirect()->route('posts.index');
		}
		else 
		{
			return redirect()->route('posts.index');
		}
		return view('posts.edit')->with('post',$post)->with("sameAuthorAsUser",$sameAuthorAsUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->validate($request,array(
			'title' => 'required|max:255','content' => 'required'
		));
		
		// store 
		$post = Article::find($id);
		$post->title = $request->input('title');
		$post->content = $request->input('content');
		
		$user = Auth::user();
	
		if ($user->id == $post->author)
		{
			$post->save();
		}
		else
		{
			return redirect()->route('posts.index');
		}
		return redirect()->route('posts.show',$post->id);		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Article::find($id);
		
		$user = Auth::user();
	
		if ($user->id == $post->author)
		{
			$post->delete();
		}	
		return redirect()->route('posts.index');		
    }
}
