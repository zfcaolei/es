<?php

namespace App\Models;
//Markdowner

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;



    public $timestamps = false;


    protected $fillable = [
        'title',
        'outline',
        'content',
        'add_time',
    ];



    public function searcheableAs()
    {
        return "articles_index";
    }


    protected $table = 'articles';

    public function getScoutKey()
    {
        return $this->id;
    }

    //定义哪些字段需要搜索
    public function toSearchableArray()
    {
        $data = [
            'title' => $this->title,
            'outline' => $this->outline,
            'content' => $this->content,
        ];
        return $data;

    }

}