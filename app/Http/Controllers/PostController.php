<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{

    public function showPosts()
    {
        return Post::with(['categories:name,slug', 'user:id,name'])
            ->select(['id','name','slug','extract','published','user_id'])
            ->where('published','<>', null)->paginate();
    }

    public function show(Post $post)
    {

    }


    public function index()
    {

    }


    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        //
    }



    public function edit(Post $post)
    {
        //
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
