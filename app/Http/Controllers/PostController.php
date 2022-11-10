<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;


class PostController extends Controller
{

    public function showPosts()
    {
        return Post::with(['categories:name,slug', 'user:id,name'])
            ->select(['id', 'name', 'slug', 'extract', 'published', 'user_id'])
            ->where('published', '<>', null)->paginate();
    }

    public function show(Post $post)
    {
        return $post->load(['categories:name,slug', 'user:id,name']);
    }

    public function index()
    {
        return Post::with(['categories:name,slug', 'user:id,name'])
            ->select(['id', 'name', 'slug', 'extract', 'published', 'user_id'])
            ->paginate();
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return response()->json($post, 201);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return $post->update($request->validated());
    }

    public function delete(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }


}
