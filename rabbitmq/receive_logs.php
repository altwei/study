<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/15
 * Time: 23:56
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connect->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

list($queue_name, ,) = $channel->queue_declare('');
$channel->queue_bind($queue_name, 'logs');
echo " [*] Waiting for logs. To exit press CTRL+C" . PHP_EOL;

$callback = function ($msg) {
    echo ' [x] ', $msg->body, PHP_EOL;
};
$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connect->close();