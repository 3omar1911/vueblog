<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
	public function index(Request $request)
	{
		$posts = Post::orderBy('id', 'desc');
		if($request->filled('tag')) {
			$posts = $posts->whereHas('tags', function($query) {
				$query->where('tags.title', request()->tag);
			});
		}
		$posts = $posts->get();
		return response()->json($posts);
	}

	public function store(Request $request)
	{
		Post::create([
			'title' => $request->title,
			'description' => $request->desc,
		]);

		return response()->json([
			'success' => true,
		]);
	}

	public function update(Request $request, $id)
	{
		Post::where('id', $id)->update([
			'title' => $request->title,
			'description' => $request->desc,
		]);

		return response()->json([
			'success' => true,
		]);
	}

	public function getPostData($id)
	{
		$post = Post::find($id);
		return response()->json([
			'post' => $post,
			'tags' => $post->tags,
		]);
	}

	public function destroy($id)
	{
		Post::where('id', $id)->delete();

		return response()->json([
			'success' => true,
		]);
	}
}
