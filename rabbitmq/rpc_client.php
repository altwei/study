<?php
/**
 * Created by PhpStorm.
 * User: altwei
 * Date: 2019/6/17
 * Time: 2:55
 */

require_once './vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
USE PhpAmqpLib\Message\AMQPMessage;

class FibonacciRpcClient
{
    private $connect;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;

    public function __construct()
    {
        $this->connect = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connect->channel();

        list($this->callback_queue, ,) = $this->channel->queue_declare('', false, false, true, false);

        $this->channel->basic_consume($this->callback_queue, '', false, true, false, false, [$this, 'onResponse']);
    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function call($n)
    {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage((string)$n, ['correlation_id' => $this->corr_id, 'reply_to' => $this->callback_queue]);
        $this->channel->basic_publish($msg, '', 'rpc_queue');

        while (!$this->response) {
            $this->channel->wait();
        }

        return intval($this->response);
    }
}

$fibonacci_rpc = new FibonacciRpcClient();
$response = $fibonacci_rpc->call(2);

echo ' [.] Got: ', $response, PHP_EOL;