<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function newsByAuthor($authorId)
    {
        $news = News::where('author_id', $authorId)->with('author')->get();

//Можно обойтись без указания автора и сделать выборку данных об авторе. Можно проводить множество манипуляций.
// Также можно получить много новостей об авторе и затем разбить их на страницы (например, по 10 новостей на странице)
// при помощи пагинации. так и везде

         return response()->json($news);
    }
    public function newsByCategory($categoryId)
    {
        $news = News::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->with('author')->get();

        return response()->json($news);
    }



    public function searchNewsByCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = Category::findOrFail($request->input('category_id'));
        $news = $category->news()->with('categories')->paginate(10);

        return response()->json($news);
    }

    public function newsById($id)
    {
//        return '1';
        $news = News::with('author')->findOrFail($id);

        return response()->json($news);
    }

    public function searchNewsByTitle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $title = $request->input('title');
        $news = News::where('title', 'like', "%{$title}%")->get();

        return response()->json($news);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $news = News::create([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'published_at' => $request->input('published_at'),
            'author_id' => $request->input('author_id'),
        ]);

        $categoryIds = $request->input('category_ids');
        $news->categories()->attach($categoryIds);

        return response()->json($news, 201);
    }
}
