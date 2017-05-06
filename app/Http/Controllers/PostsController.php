<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Session;
use Purifier;
use Image;
use Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        return view('posts.index')->withPosts($posts);
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
        $this->validate($request, [
          'title' => 'required|max:255',
          'body'  => 'required',
          'featured_img' => 'sometimes|image'
        ]);

        $post = new Post;

        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('img/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $post->image = $filename;
        }

        $post->save();

        Session::flash('success', 'Post was successfully created !');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->withPost($post);
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
      $this->validate($request, [
        'title' => 'required|max:255',
        'body'  => 'required',
        'featured_img' => 'image'
      ]);

      $post = Post::find($id);

      $post->title = $request->title;
      $post->body = Purifier::clean($request->body);

      if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('img/' . $filename);
        Image::make($image)->resize(800, 400)->save($location);
        $oldFilename = $post->image;

        $post->image = $filename;

        Storage::delete($oldFilename);
      }


      $post->save();

      Session::flash('success', 'Post was successfully updated !');

      return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Storage::delete($post->image);

        Session::flash('success', 'Post was successfully deleted !');

        return redirect()->route('posts.index');
    }
}
