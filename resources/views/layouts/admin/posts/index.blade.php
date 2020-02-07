@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check())
        <div class="row">
                <div class="col-md-12">
                   <a href="{{route('post.create')}}" class="btn btn-success btn-md mb-2">New Post</a>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                @foreach ($posts  as $post)
                 
                    <div class="card mb-5">
                        <div class="card-header">
                            <a href="{{route('post.show',$post->id)}}"><h5>{{$post->title}} <span style="font-size:12px;">{{date('d M Y',strtotime($post->created_at))}}</span></h5></a>
                        </div>
                        <div class="card-body">
                            {{--  {{Str::limit($post->content,100,'.......')}} <br>  --}}
                            {{--  {!! nl2br($post->content) !!}  --}}
                            {{$post->excerpt}}
                            <p>Posted By : <strong>{{$post->author->name}}</strong></p>
                            <p>Is Published : <strong>{{$post->is_pulish ? 'Yes' : 'No'}}</strong></p>
                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-primary w-20">Read More</a>
                            @if ($post->author_id == auth()->user()->id)
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-warning" style="width:100px;">Edit</a>
                            @endif
                            
                        </div>
                    </div>
               
                @endforeach
            </div>
        </div>
    </div>

@endsection