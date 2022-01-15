<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ESInit extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化es索引';

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
        $client = new Client();
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/laravel_tmp_1';
        $client->put($url, [
            'json' => [
                'index_patterns' => config('scout.elasticsearch.index'),
                'settings'       => [
                    'number_of_shards'   => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings'       => [
                    '_doc' => [
                        '_source'           => [
                            'enabled' => true,
                        ],
                        //具体设置字段
                        'properties'        => [
                            'created_at' => [
                                'type'   => 'date',
                                'format' => 'yy-MM-dd HH:mm:ss||yy-MM-dd||epoch_millis',
                            ],
                        ],
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping'            => [
                                        'type'     => 'text',
                                        'analyzer' => 'ik_smart',
                                        'fields'   => [
                                            'keyword' => [
                                                'type'         => 'keyword',
                                                'ignore_above' => 256,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $this->info('创建模板成功');

        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');

        $client->put($url, [
            'json' => [
                'settings' => [
                    'refresh_interval'   => '5s',
                    'number_of_shards'   => 1,
                    'number_of_replicas' => 0,
                ],
            ],
        ]);

        $this->info('创建索引成功');

        return true;
    }
}
