<?php
/**
 * Created by PhpStorm.
 * User: zz-med
 * Date: 2019/3/19
 * Time: 下午4:14
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Elasticsearch\ClientBuilder;

class testController
{

    public function a()
    {

        date_default_timezone_set('PRC');
        // Create the logger
        $logger = new Logger('my_logger');
        // Now add some handlers
        $logger->pushHandler(new StdoutHandler());

        $config = \Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('10.13.4.159:9192');
        $config->setGroupId('test');
        $config->setBrokerVersion('1.0.0');
        $config->setTopics(['test']);
        //$config->setOffsetReset('earliest');
        $consumer = new \Kafka\Consumer();
        $consumer->setLogger($logger);
        $consumer->start(function ($topic, $part, $message) {
            var_dump($message);
        });

    }


    public function b()
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc']
        ];

        $response = $client->index($params);
        print_r($response);

        $params = Input::all();
        $b = $params['b'] ?? '';
        $a = 33;
        echo  $b,$a;

    }
}