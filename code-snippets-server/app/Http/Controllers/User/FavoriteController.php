<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Response;
use App\Models\User;
use App\Models\Snippet;

class FavoriteController extends Controller
{
    public function getFavorites(Request $request)
    {
        $user = $request->user();
        $favorites = $user->favoriteSnippets()->with(['user', 'tags'])->get();

        return Response::response(true, "", $favorites);
    }

    public function addFavorite(Request $request)
    {
        $user = $request->user();
        $snippetId = $request->input('snippet_id');

        $snippet = Snippet::find($snippetId);
        if (!$snippet) {
            return Response::response(false, "Snippet not found.");
        }

        if ($user->favoriteSnippets()->find($snippetId)) {
            return Response::response(false, "Snippet already favorited.");
        }

        $user->favoriteSnippets()->attach($snippetId);
        return Response::response(true, "Snippet added to favorites successfully");
    }

    public function removeFavorite(Request $request, $snippetId)
    {
        $user = $request->user();

        if (!$user->favoriteSnippets()->find($snippetId)) {
            return Response::response(false, "Favorite snippet not found.");
        }

        $user->favoriteSnippets()->detach($snippetId);
        return Response::response(true, "Snippet removed from favorites successfully");
    }
}
