<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServeDocumentsController extends Controller
{
    //

    public function GetDocumentByID(Request $request)
    {
        # code...
        return '{"error":false}';
    }

    public function GetDocumentInfomation(Request $request)
    {
        # code...
        return '{"error":false}';
    }


    public function SearchDocuments(Request $request)
    {
        # code...
        return '{"error":false}';
    }


    public function DownloadDocumentResource(Request $request, $resource_id)
    {
        # code...
        return '{"error":false}';
    }
}
