@extends('layouts.app')
@section('content')
    <div class="container">
            <form action="{{route('post.store')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="content">Description</label>
                            <textarea name="content" id="content" class="form-control" cols="30" rows="10" required>{{old('content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="is_pulish">Is Publish</label>
                            <input type="radio" value="1" name="is_pulish" id="is_pulish" checked> Yes 
                            <input type="radio" value="0" name="is_pulish" id="is_pulish"> No
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </div>
             </form>
    </div>
@endsection