<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function showPosts()
    {
        return Post::with(['categories:id,name,slug', 'user:id,name'])
            ->select(['id', 'name', 'slug', 'extract', 'published', 'user_id'])
            ->published()->paginate();
    }

    public function getPost(Request $request)
    {

        $post = Post::where('slug', $request->slug)->published()->firstOrFail();
        return $post->load(['categories:id,name,slug', 'user:id,name']);
    }

    public function index()
    {
        return Post::with(['categories:name,slug', 'user:id,name'])
            ->select(['id', 'name', 'published', 'user_id'])
            ->paginate();
    }

    public function show(Post $post)
    {
        return $post->load(['categories:name,slug', 'user:id,name:email']);
    }

    public function store(StorePostRequest $request)
    {
        $res = $request->validated();
        $res['user_id'] = auth()->id();
        $post = Post::create($res);
        $post->categories()->attach($request->categories);
        return response()->json($post, 201);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
         $post->update($request->validated());
         $post->categories()->sync($request->categories ?? []);
         return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }


}
