@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>{{$post->title}} <span style="font-size:12px;">{{date('d M Y',strtotime($post->created_at))}}</span></h5>
                 {!! nl2br($post->content) !!}
                 <br><br>
                 <p>Posted By : <strong>{{$post->author->name}}</strong></p>
                 <p>Is Published : <strong>{{$post->is_pulish ? 'Yes' : 'No'}}</strong></p>
                 <a href="{{route('post.index')}}" class="btn btn-success btn-sm">Back to List</a> <br>
                 @if (!$post->is_pulish)
                     <form action="{{route('post.update',$post->id)}}" method="post">
                         @method("PUT")
                         @csrf
                         <button class="btn btn-sm btn-primary mt-3"  type="submit">Publish</button>
                    </form>  
                 @endif
            </div>
        </div>
    </div>
@endsection