<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
	public function index()
	{
		$tags = Tag::all();
		return response()->json($tags);
	}
}
