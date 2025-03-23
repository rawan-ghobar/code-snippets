<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\Response;
use App\Models\Snippet;

class SnippetController extends Controller{

    function getSnippets($count, $page, $language =null,$tags = null, $id = null){

        if($id == null){

            $query = Snippet::with('tags');

            if($language !== null){
            $query->where('language', $language);
            }

        if($tags !== null){
            $query->whereHas('tags', function($q) use($tags){
                $q->whereIn('id', (array) $tags);
            });
            }

        $snippets = $query->paginate($count, ['*'], 'page', $page);

        return Response::response(true, "", $snippets);

        }

        $snippet = Snippet::with('tags')->find($id);

        if($snippet){
            return Response::response(true, "", $snippet);
        }

        return Response::response(false, "Not found");
    }

    function addOrUpdateSnippet(Request $request, $id = "add"){
        $operation = ($id == "add") ? "addition" : "update";

        if($id == "add"){
            $snippet = new Snippet;
        }else{
            $snippet = Snippet::find($id);
            if(!$snippet){
                return Response::response(false,"Failed");
            }
        }

        $snippet->title = $request["title"];
        $snippet->content = $request["content"];
        $snippet->language = $request["language"];
        $snippet->save();

        if ($request->has('tags')) {
            $snippet->tags()->sync($request['tags']);
        }

        return Response::response_op(true, "Success", $operation, $snippet->load('tags'));
    }
}
