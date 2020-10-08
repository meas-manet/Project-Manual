<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderby('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $post);
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
        //Handle FIle Upload
        if($request->hasFile('cover_Image')){
            //Get File name with extension
            $filenameWithExt = $request->file('cover_Image')->getClientOriginalName();

            //Get just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_Image')->getClientOriginalExtension();
            //Filename to Store
            $filenametoStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_Image')->storeAs('public/cover_images', $filenametoStore);
        }else{
            $filenametoStore = 'noimage.jpg';
        }


        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->cover_Image = $filenametoStore;
        $post->save();
            
        return redirect('/posts')->with('success','Post Created!');
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
        return view('posts.show')->with('post', $post);
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

        if(Auth::user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'UnAuthorized!!!');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         //Handle FIle Upload
         if($request->hasFile('cover_Image')){
            //Get File name with extension
            $filenameWithExt = $request->file('cover_Image')->getClientOriginalName();

            //Get just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_Image')->getClientOriginalExtension();
            //Filename to Store
            $filenametoStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_Image')->storeAs('public/cover_images', $filenametoStore);
        }

        $post = Post::find($request->id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_Image')){
            $post->cover_Image = $filenametoStore;
        }
        $post->save();

        // dd($request->input());
           
        return redirect('/posts')->with('success','Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function meDelete(Request $request)
    {
        $post = Post::find($request->id);

        if(Auth::user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'UnAuthorized!!!');
        }

        if($post->cover_Image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_Image);
        }


        $post->delete();
        return redirect('/posts')->with('success','Post Deleted!');
    }

    public function download($id){
        $post = Post::find($id);
        return Storage::download('public/cover_images/'.$post->cover_Image);
    }

}
