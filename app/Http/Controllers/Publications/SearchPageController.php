<?php

namespace App\Http\Controllers\Publications;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Components\PaginationComponent;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Author;
use \Auth;

class SearchPageController extends Controller
{
    //
    
    const ITEMS_PER_PAGE = 25;

    public function ShowSearchPage(Request $request){
        $request->validate([
            's' => 'required|string',
        ]);

        if ($request->has('search_by') && $request->search_by == 'author'){
            $publications = $this->SearchByAuthor($request);
        }else{
            //advanced search uses full text search
            if ($request->has('advanced_search') && $request->advanced_search == 'yes'){
                $publications = Publication::WhereRaw([
                    '$text' => ['$search'=>trim($request->s)]
                ]);
            }else{
                $publications = Publication::where('title', 'like', '%'.trim($request->s).'%');
            }
        }
        $publications = $publications->get();
        $npages = ceil($publications->count() / SearchPageController::ITEMS_PER_PAGE);
        
        //pagination
        $currnet_page = $request->has('page') ? $request->page : 1;
        $offset = ($currnet_page - 1) * SearchPageController::ITEMS_PER_PAGE;
        $publications = $publications->skip($offset)->take(SearchPageController::ITEMS_PER_PAGE);

        

        if ($currnet_page != 1 && $publications->count() == 0){
            abort(404);
        } 

        if ($npages > 1){
            $pagination = PaginationComponent::create($request, $npages, $currnet_page);
        }else{
            $pagination = "";
        }

        

        return view('nonuser.search_results', [
            'publications' => $publications,
            'pagination' => $pagination,
        ]);
    }

    public function SearchByAuthor(Request $request){
        
        if ($request->has('advanced_search') && $request->advanced_search == 'yes'){
            $author = Author::where('first_name', 'like', '%'.trim($request->s).'%')
                                ->orWhere('last_name', 'like', '%'.trim($request->s).'%')
                                ->orWhere('middle_name', 'like', '%'.trim($request->s).'%')
                                ->limit(10)->get();
        }else{
            $author = Author::where('first_name', 'like', '%'.trim($request->s).'%')->limit(10)->get();
        }
        //Get the author id
        $ids = [];
        foreach ($author as $a){
            $ids[] = $a->_id;
        }
        return Publication::whereRaw(['author_id'=>['$in'=> $ids]]);
    }
}
