<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/17
 * Time: 1:07
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connect->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

$routing_key = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'anonymous.info';
$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = 'hello world!';
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'topic_logs', $routing_key);

echo ' [x] Sent: ', $routing_key, ':', $data, PHP_EOL;

$channel->close();
$connect->close();