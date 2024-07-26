<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return Post::with('tags')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = null;

        DB::transaction(function () use ($request, &$post) {
            /** @var User $user */
            $user = $request->user();

            $post = Post::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'user_id' => $user->id,
            ]);

            if ($request->has('tags')) {
                $tags = $this->syncTags($request->input('tags'));
                $post->tags()->sync($tags);
            }
        });

        return response()->json($post->load('tags'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post->load('tags'), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Post $post)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        DB::transaction(function () use ($request, $post) {
            $post->update($request->only('title', 'description'));

            if ($request->has('tags')) {
                $tags = $this->syncTags($request->input('tags'));
                $post->tags()->sync($tags);
            }
        });

        return response()->json($post->load('tags'), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Sync tags - create if not exist, return array of tag ids.
     *
     * @param array $tags
     * @return array
     */
    protected function syncTags(array $tags): array
    {
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }
}
