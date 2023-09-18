<?php

namespace App\Http\Controllers\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use \Auth;

class EditorController extends Controller
{
    //
    public function ShowNewDocumentPage(Request $request){
        if (!$request->has('draft_id')){
            return redirect('/user/editor/wizard');
        }

        $pub = Publication::find($request['draft_id']);
        
        return view('editor.editor', [
            'publication' => $pub,
        ]);
    }
}
