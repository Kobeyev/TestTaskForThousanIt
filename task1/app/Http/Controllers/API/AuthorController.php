<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function authorsList()
    {
        $authors = Author::all();

        return response()->json($authors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|url',
        ]);

        $author = Author::create($validatedData);

        return response()->json($author, 201);
    }
}
