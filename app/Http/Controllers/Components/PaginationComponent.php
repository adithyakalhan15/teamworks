<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PaginationComponent extends Controller
{
    //
    public static function Create(Request $request, $npages, $currnet_page, $items_per_page=25){
        //setup pagination info
        //let's create an array of pages [first, n-2, n -1, n ,n + 1, n + 2, last]
        $pages = [];
        $queryParameters = $request->query();
        //unset($queryParameters['page']);
        $queryParameters['page'] = 1;
        $pages[0] = [
            'text' => 'First',
            'page' => 1,
            'url' => $fullUrlWithQuery = $request->url() . '?' . http_build_query($queryParameters),
            'is_current' => $currnet_page == 1,
        ];

        for ($i = $currnet_page - 2; $i <= $currnet_page + 2; $i++){
            if ($i >= 1 && $i <= $npages){
                $queryParameters['page'] = $i;
                $pages[] = [
                    'text' => $i,
                    'page' => $i,
                    'url' => $fullUrlWithQuery = $request->url() . '?' . http_build_query($queryParameters),
                    'is_current' => $currnet_page == 1,
                ];
            }
        }
        $queryParameters['page'] = $npages;
        $pages[] = [
            'text' => 'Last',
            'page' => $npages,
            'url' => $fullUrlWithQuery = $request->url() . '?' . http_build_query($queryParameters),
            'is_current' => $currnet_page == 1,
        ];


        return view('components.pagination', [
            'pages' => $pages,   
        ]);
    }
}
