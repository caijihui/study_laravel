<?php
/**
 * 接收消息
 */

$exchangeName = 'logs';

// 建立TCP连接
$connection = new AMQPConnection([
    'host' => 'localhost',
    'port' => '5672',
    'vhost' => '/',
    'login' => 'guest',
    'password' => 'guest'
]);
$connection->connect() or die("Cannot connect to the broker!\n");

$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName($exchangeName);
$exchange->setType(AMQP_EX_TYPE_FANOUT);
$exchange->declareExchange();

$queue = new AMQPQueue($channel);
$queue->setFlags(AMQP_EXCLUSIVE);
$queue->declareQueue();
$queue->bind($exchangeName);

var_dump("Waiting for message...");

// 消费队列消息
while(TRUE) {
    $queue->consume('processMessage');
}

// 断开连接
$connection->disconnect();

function processMessage($envelope, $queue) {
    $msg = $envelope->getBody();
    var_dump("Received: " . $msg);
    $queue->ack($envelope->getDeliveryTag()); // 手动发送ACK应答
}