<?php

namespace App\Http\Controllers;

use App\Post;
use App\Mail\PostUpdate;
use App\Mail\PostCreate;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Cache;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $repository;
    public $service;

    public function __construct(PostRepository $repository,PostService $service){
        $this->repository = $repository;
        $this->service = $service;
    }
    public function index()
    {

        $posts = $this->repository->memberPost();
        return view('layouts.admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create",Post::class);
        return view('layouts.admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $this->authorize("create",Post::class);
        $post = $request->validated();
        $post['author_id'] = auth()->user()->id;
       
        //$createpost =$this->repository->store($post);
        $createpost =$this->service->make($post);
        Cache::forever("post".$createpost->id, $createpost);
        \Mail::to("myothihakyaw.cu@gmail.com")->send(new PostCreate($post));
        return redirect(route('post.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view',$post);
        \Mail::to("myothihakyaw.cu@gmail.com")->send(new PostUpdate($post));
         if(Cache::get('post'.$post->id)){
           // dump(Cache::get('post'.$post->id));
         }else{
            Cache::put('post'.$post->id, $post, 100);
         }
         
        return view('layouts.admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('view',$post);
        return view('layouts.admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
       $this->authorize('update',$post);
       $data = $request->validated();
       $post = $this->service->update($post->id,$data);
       return redirect(route('post.show',$post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }




    //CREATE POST AND CACHE IT ... 

}
