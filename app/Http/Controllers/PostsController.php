<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')->get();
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
		return response()->json(Post::find($id));
	}

	public function destroy($id)
	{
		Post::where('id', $id)->delete();

		return response()->json([
			'success' => true,
		]);
	}
}
