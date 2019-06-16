<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/15
 * Time: 23:12
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connect->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

$data = implode('', array_slice($argv, 1));
if (empty($data)) {
    $data = 'info: hello world';
}

$channel->basic_publish(new AMQPMessage($data), 'logs');