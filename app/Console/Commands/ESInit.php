<?php
namespace App\Console\Commands;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ESInit extends Command {

    protected $signature = 'es:init';

    protected $description = 'init laravel es for news';

    public function __construct() { parent::__construct(); }

    public function handle() { //创建template
        $client = new Client(['auth'=>['elastic', 'cjh']]);
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/news';
        $params = [
            'json' => [
                'template' => config('scout.elasticsearch.index'),
                'settings' => [
                    'number_of_shards' => 5
                ],
                'mappings' => [
                    '_default_' => [
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'ignore_above' => 256,
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url, $params);

        // 创建index
        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');

        $params = [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 5,
                    'number_of_replicas' => 0
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url, $params);

    }
}