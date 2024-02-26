<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postLists = Post::with('detail', 'author')->get();

        $postListsFormatted = $postLists->map(function ($post) {
            return [
                'id' => $post->uuid,
                'title' => $post->title,
                'category' => $post->category,
                'image' => $post->image,
                'slug' => $post->slug,
                'detail' => [
                    'date' => Carbon::parse($post->detail->start_date)->format('M j, Y') . ' - ' . Carbon::parse($post->detail->end_date)->format('M j, Y') ,
                    'time' => Carbon::parse($post->detail->start_date)->format('H:i') . ' - ' . Carbon::parse($post->detail->start_date)->format('H:i'),
                    'desc' => $post->detail->description,
                    'tags' => json_decode($post->detail->tags),
                ],
                'author' => [
                    'name' => $post->author->name,
                    'uuid' => $post->author->uuid,
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'postLists' => $postListsFormatted], 
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
