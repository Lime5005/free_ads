<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\Category;
use Auth;

class PostController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        $cat = Category::all();
        return view('posts.index')->with(['posts' => $posts, 'cat' => $cat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::all();
        $cat = Category::all();
        return view('posts.create', ['post' => $post, 'cat' => $cat]);
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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'cover_image' => 'image|required|max:1999',
            'price' => 'required',
            'condition' => 'required',
            'location' => 'required',
        ]);

        // Get the whole file name uploaded with Laravel's function
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get only the file name with PHP build-in function
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get the extension type
        $extension = $request->file('cover_image')->extension();
        // Store as a unique name
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('cover_image')->storeAs('cover_images/', $fileNameToStore);
        // Create and store a thumb picture
        // $thumbToStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        // $thumb = Image::make($request->file('cover_image')->getRealPath());
        // $thumb->resize(80, 80);
        // $thumb->save('storage/cover_images/'.$thumbToStore);

        // Create a post
        $post = new Post;
        $post->title = $request->input('title');
        $post->category_id = $request->category_id;
        $post->description = $request->input('description');
        $post->price = $request->input('price');
        $post->condition = $request->input('condition');
        $post->location = $request->input('location');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Ads Created');

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

    public function search(Request $request) 
    {
        $keyword = $request->input('search');
        $posts = Post::where('title', 'LIKE', '%'.$keyword.'%')->get();
        return view('posts.searchposts', ['posts' => $posts]);
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
        $cat = Category::all();
        if(!isset($post)) {
            return redirect('/posts')->with('error', 'No Ads Found');
        }
        // User is not allowed to edit other users' post
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit', ['post' => $post, 'cat' => $cat]);
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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'cover_image' => 'image|required|max:1999',
            'price' => 'required',
            'condition' => 'required',
            'location' => 'required',
        ]);

        $post = Post::find($id);
        // Upload the new image
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->extension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        // Delete the old image
        Storage::delete('public/cover_image'.$post->cover_image);
        $thumbToStore = 'thumb'.$filename.'_'.time().'.'.$extension;
        $thumb = Image::make($request->file('cover_image')->getRealPath());
        $thumb->resize(80, 80);
        $thumb->save('storage/cover_image'.$thumbToStore);

        // Update
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->description = $request->input('description');
        $post->price = $request->input('price');
        $post->condition = $request->input('condition');
        $post->location = $request->input('location');
        $post->cover_image = $fileNameToStore;

        $post->save();

        return redirect('/posts')->with('success', 'Ads Updated');
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
        if (!isset($post)) {
            return redirect('/posts')->with('error', 'No Ads found');
        }

        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        Storage::delete('public/cover_image/'.$post->cover_image);
        $post->delete();

        return redirect('/posts')->with('success', 'Ads Removed');
    }
}
