<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use \Auth;

class HomePageController extends Controller
{
    //
    public function ShowHomePage(Request $request){
        $publications = Publication::where('visibility', Publication::VISIBILITY_PUBLIC);
        if (Auth::check()){
            $publications->orWhere('owner_id', Auth::user()->id);
        }
        $publications = $publications->orderBy('created_at', 'desc')
                            ->select("title", "owner_id", "author_id", "slug", "created_at")
                            ->limit(10)->get();

        return view('nonuser.homepage', [
            'publications' => $publications
        ]);
    }
}
