<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
class PostController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 1000);

        $posts = BlogPost::with(['user', 'category'])->paginate($perPage);

        return response()->json($posts);
    }

    public function show(string $id)
    {
        $post = BlogPost::with(['user', 'category'])->findOrFail($id);

        return $post;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post = BlogPost::create($data);

        return response()->json($post, 201);
    }


    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $data = $request->all();

        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post->update($data);

        return response()->json($post);
    }


    public function destroy(string $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return response()->noContent();
    }
}
