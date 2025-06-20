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
}
