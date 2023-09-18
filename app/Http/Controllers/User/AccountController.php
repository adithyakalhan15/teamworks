<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use \Auth;
class AccountController extends Controller
{
    //
    public function ShowProfilePage(Request $request){
        //get publications
        $publications = Publication::where('owner_id', Auth::id())->select('title', 'slug', 'created_at')->get();
        //Auth::user()->publications()->get();
        return view('user.myaccount', [
            'publications' => $publications,
        ]);
    }
}
