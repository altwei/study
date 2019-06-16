<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/16
 * Time: 23:55
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connect->channel();

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
list($queue_name, ,) = $channel->queue_declare('', false, false, true, false);

$severities = array_slice($argv, 1);
if (empty($severities)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]" . PHP_EOL);
    exit(1);
}

foreach ($severities as $severity) {
    $channel->queue_bind($queue_name, 'direct_logs', $severity);
}

echo ' [*] Waiting for logs. To exit press CTRL+C', PHP_EOL;

$callback = function ($msg) {
    echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, PHP_EOL;
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connect->close();