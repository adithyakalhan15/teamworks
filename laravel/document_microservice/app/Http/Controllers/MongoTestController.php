<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TestMDB;

class MongoTestController extends Controller
{
    //

    public function AddElement(Request $request)
    {
        # code...
        if ($request->has('c')){
            $m = new TestMDB();
            $m->name = $request['c'];
            $m->time = time();
            $m->save();
            echo "saved";
            print_r($m);
        }else{
            echo "no c def";
        }
    }

    public function GetElement(Request $request)
    {
        # code...
        if ($request->has('c')){
            $m = TestMDB::where("name", "like", "%" . $request['c'] . "%")->get()->all();
            //echo $m->name;
            //echo $m->time;
            //echo "<br>saved";
            foreach ($m as $x){
                echo "$x->name @ $x->time on $x->id<br>";
            }
        }else{
            echo "no c def";
        }
    }
}
