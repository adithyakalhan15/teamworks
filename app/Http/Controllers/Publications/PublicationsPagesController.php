<?php

namespace App\Http\Controllers\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;
use App\Models\Publication;
use App\Models\User;
use App\Models\Author;
use \Auth;

class PublicationsPagesController extends Controller
{
    //ShowPublicationPage 
    public function ShowPublicationPage(Request $request, $publication_slug){
        $publication = Publication::with('authors')->where('slug', $publication_slug)->where(function ($col){
            if (Auth::check()){
                $col->where('visibility', Publication::VISIBILITY_PUBLIC)
                    ->orWhere('owner_id', Auth::user()->id);
            }else{
                $col->where('visibility', Publication::VISIBILITY_PUBLIC);
            }
            
        })->first();

        if (is_null(!$publication)){
            //abort(404)
            return abort(404);
        }

        return view('nonuser.publication', [
            'publication_slug' => $publication_slug,
            'publication' => $publication,
        ]);
    }


    public function ShowAutherPage(Request $request, $author_slug){
        //
        $author = Author::where('slug', $author_slug)->orWhere("_id", $author_slug)->first();
        if (is_null($author)){
            return abort(404);
        }


        $publications = Publication::whereRaw(['author_id'=> ['$in' => [new ObjectId($author->_id)]]])
                        ->select('title', 'slug', 'created_at')->get();

        return view('nonuser.author', [
            'author' => $author,
            'publications' => $publications,
        ]);

    }
}
/*
->where(function ($col){
            if (Auth::check()){
                $col->where('visibility', Publication::VISIBILITY_PUBLIC)
                    ->orWhere('owner_id', Auth::user()->id);
            }else{
                $col->where('visibility', Publication::VISIBILITY_PUBLIC);
            }
            
        })*/