<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Banner;
use Illuminate\Console\Command;
use  \Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;

class ESOpenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $order = Article::where(['id'=>104])->first();
        $order->title = "王鑫";
        $order->outline = "爱仕达多撒多阿萨肛裂达萨达阿达大声道曹磊";
        $order->content = "今天是2022年晚上";
        $order->add_time = time();
        $order->save();


//
//

    }
}
