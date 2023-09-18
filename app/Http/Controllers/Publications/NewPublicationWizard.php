<?php

namespace App\Http\Controllers\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use \Auth;

class NewPublicationWizard extends Controller
{
    //

    /**
     * There are 3 ways to create a new publication:
     *  1. from word document DOC or DOCX
     *  2. from PDF
     *  3. from scratch (Using the Editor)
     *  
     *  This will ask from the first page
     */
    public function ShowNewPublicationWizard(Request $request){
        //check permissions
        if (Auth::user()->hasPermissions(User::TASK_CREATE_PUBLICATIONS) == false){
            return abort(403);
        }

        return view('editor.editor_wizard');
    }

    
    /**
     * Here, the request is processed based on the selection.
     * If file was used, it should be uploaded
     */
    public function PWProcessSelection(Request $request){
        $request->validate([
            'creation_method' => 'required|in:word,pdf,scratch',
        ]);

        $selection = $request['creation_method'];
        if ($selection == 'word'){
            return redirect('/user/new_publication_wizard/word');
        }else if ($selection == 'pdf'){
            return redirect('/user/new_publication_wizard/pdf');
        }else if ($selection == 'scratch'){
            //create draft publication
            return redirect('/user/editor/?draft_id=' . $this->CreateDraftPublication()->_id);
        }else{
            return redirect()->back()->withErrors(['selection' => 'Invalid selection']);
        }
    }


    private function PWProcessWord(Request $request){
        $request->validate([
            'file' => 'required|mimes:doc,docx',
        ]);

        //upload the file
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file->storeAs('temp', $file_name);

        //process the word file and Extract publication object
        //tempory fn
        $ProcessDOCX = function ($file_name) {return new Publication();};
        $pub = $ProcessDOCX($file_name);

        //delete the tenpory file
        Storage::delete('temp'. DIRECTORY_SEPERATOR . $file_name);

        if (is_null($pub)){
            return redirect()->back()->withErrors(['Inva' => 'Invalid file']);
        }

        $pub->visibility = Publication::VISIBILITY_DRAFT;

        //redirect to editor the id
        return redirect('/user/editor/' . $pub->_id);
    }   

    private function CreateDraftPublication(){
        $pub = new Publication();
        $pub->title = "Untitled";
        $pub->visibility = Publication::VISIBILITY_DRAFT;
        $pub->author_id = [Auth::id()];
        $pub->owner_id = Auth::id();
        $pub->save();
        return $pub;
    }


}
