<?php 
namespace App\Services;
use App\Mail\PostUpdate;
use App\Mail\PostCreate;
use App\Post;
use Cache;
use Mail;
class PostService{

    public function make($data){
        
        // $data['author_id'] = \Auth::user()->id;
        $post = Post::create($data);

        Cache::forever('post.' . $post->id, $post);

        Mail::to('th.ucsy@gmail.com')->send(
            new PostCreate($post)
        );

        return $post;
    }


    public function update($id,$data)
    {
        $post = Post::find($id);
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->is_pulish = $data['is_pulish'];
        $post->save();
        Cache::forever('post.' . $post->id, $post);
        Mail::to("myothihakyaw.cu@gmail.com")->send(new PostUpdate($post));
        return $post;
    }
} 