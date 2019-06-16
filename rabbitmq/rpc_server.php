<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/17
 * Time: 2:45
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connect->channel();

$channel->queue_declare('rpc_queue', false, false, false, false);

function fib($n)
{
    if ($n == 0 || $n == 1) {
        return $n;
    }
    return fib($n - 1) + fib($n - 2);
}

echo ' [x] Awaiting RPC requests', PHP_EOL;

$callback = function ($req) {
    $n = intval($req->body);
    echo ' [.]fib(', $n, ')', PHP_EOL;

    $msg = new AMQPMessage(
        (string)fib($n),
        ['correlation_id' => $req->get('correlation_id')]
    );

    $req->delivery_info['channel']->basic_publish($msg, '', $req->get('reply_to'));

    $req->delivery_info['channel']->basic_ack($req->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('rpc_queue', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connect->close();