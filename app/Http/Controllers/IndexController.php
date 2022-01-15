<?php
/**
 * Created by PhpStorm.
 * User: windows 10
 * Date: 2022/1/13
 * Time: 22:49
 */
namespace App\Http\Controllers;
use App\Article;
use  \Elasticsearch\ClientBuilder;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\DB;

class IndexController extends \App\Http\Controllers\Controller{



    public function index(){

        $student=DB::select("select * from app_banner");
        //返回一个二维数组  $student
       foreach ($student as $v){
           var_dump($v->title);
       }


    }

    public function test()
    {
        //查询
        $article = \App\Models\Article::search("肛裂")->get();
       var_dump($article);

//       $data = \App\Models\Article::where('id', '=', 81)->searchable();
//        var_dump($data);

    }

}