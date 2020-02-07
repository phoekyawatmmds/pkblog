<?php 
namespace App\Repositories;
use App\Post;
class PostRepository{

    public function find($id){
            return Cache::rememberForever('post'.$id,function() use($id){
                return Post::findOrFail($id);
            });
    }

    public function all(){
        
    }

    public function memberPost()
    {
        if(auth()->check()){
            $posts = Post::published()->orWhere->author(auth()->user()->id)->get();
        }else{
            $posts = Post::published()->get();
        }

        return $posts;
    }


    public function store($post)
    {
        $createpost = Post::create($post);
        return $createpost;
    }
   
} 