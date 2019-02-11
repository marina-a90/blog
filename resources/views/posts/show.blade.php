@extends('layouts.master')

@section('title', $post->title) 
{{-- //ovako kad imam samo jednu, ne mora ni a se zatvori ejr nema nista iznmedju --}}


@section('content')
    <div>
        <h1>{{ $post->title }}</h1>
        <div>{{ $post->body }}</div>
        <hr>
    </div>
    @foreach($post->comments as $comment)
        <div class="p-4 alert alert-success">
            <div class="text-muted">{{ $comment->created_at }}</div>
            <strong>{{ $comment->author }} says:</strong> {{ $comment->text }}
        </div>
    @endforeach

    {{-- <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        <input name="author" placeholder="author"/>
        <br>
        <textarea name="comment" placeholder="comment" cols="40" rows="5"></textarea>
        <br>
        <input type="Submit" value="Submit"/>
    </form> --}}


    <div class="container">
            <form method="POST" action="{{ route(('posts.comment'), ['id' => $post->id]) }}">
                @csrf

              <div class="form-group row">
                <label for="text" class="col-4 col-form-label">Author</label>
                <input
                  id="text"
                  name="author"
                  type="text"
                  class="form-control"
                />
              </div>
        
              <div class="form-group row m-4">
                <label for="textarea" class="col-4 col-form-label">Content</label>
                <textarea
                  id="textarea"
                  name="text"
                  cols="40"
                  rows="5"
                  class="form-control"></textarea>
              </div>

              <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
              </div>

            </form>
    </div>

@endsection