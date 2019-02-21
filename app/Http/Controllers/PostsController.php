<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Mail\CommentReceived;
use App\Http\Requests\CreateCommentRequest;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();

        // $posts = Post::published()->paginate(10);                    // lazy load, nije najbolje resenje
        $posts = Post::with('user')->paginate(10);                     // WITH je bolje resenje, optimizovano

        // return view('posts.index', compact('posts' => $posts));
        return view('posts.index', compact('posts'));
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
        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required'
        ]);

        $post = Post::create(
            array_merge(
                request()->all(),
                ['user_id' => auth()->user()->id ]
            )
        );

        // Post::create($request->all()); ///menjam ovo
        
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addComment(CreateCommentRequest $request, $id) 
    {
        $comment = Comment::create([
            'post_id' => $id,
            'author' => $request->author,
            'text' => $request->text
        ]);

        if ($comment->post->user) {
            \Mail::to($comment->post->user)->send(new CommentReceived(
                $comment->post, $comment
            ));
        }

        return redirect()->back();

        // Post::findOrFail($id)
        // ->comments
        // ->create(request->all());
    }

}
