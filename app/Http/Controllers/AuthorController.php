<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Gallery;


class AuthorController extends Controller
{
    public function show(User $author)
    {
        $galleries = Gallery::where('user_id', $author->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

      return response()->json(['author' => $author, 'galleries' => $galleries]);
    }
}