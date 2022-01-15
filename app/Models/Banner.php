<?php

namespace App\Models;
//Markdowner

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Banner extends Model
{
    use Searchable;



    public $timestamps = false;


    protected $fillable = [
        'title',
        'image',
    ];



    public function searchableAs()
    {
        return "banner_index";
    }

    protected $table = 'app_banner';

    public function getScoutKey()
    {
        return $this->id;
    }

    //定义哪些字段需要搜索
    public function toSearchableArray()
    {
        $data = [
            'title' => $this->title,
            'image' => $this->image,
            'http_url' => $this->http_url,
        ];
        return $data;

    }

}