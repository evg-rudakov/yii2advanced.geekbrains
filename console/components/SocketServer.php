<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 17:43
 */

namespace console\components;


use common\models\ChatLog;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        // Для хранения технической информации об присоединившихся
        // клиентах используется технология SplObjectStorage, встроенная в PHP
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->sendWelcomeMessage($conn);
        $this->showHistory($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    private function showHistory($conn){
        $chatLogs = ChatLog::find()->all();
        foreach ($chatLogs as $log) {
            $msg = json_encode($log->attributes);
            $msg['created_at'] = \Yii::$app->formatter->asDatetime($log->created_at);
            $conn->send($msg);
        }
    }

    private function sendWelcomeMessage(ConnectionInterface $conn)
    {
        $conn->send(json_encode([
            'message'=>'Всем привет',
            'username'=>'Чат студентов geekbrains.ru',
            'created_at'=>\Yii::$app->formatter->asDatetime(time())]));
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        var_dump($msg);
        var_dump('clients:'.count($this->clients));
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $msg = json_decode($msg, true);
        $msg['created_at'] = \Yii::$app->formatter->asDatetime(time());
        $msg = json_encode($msg);
        ChatLog::saveLog($msg);

        foreach ($this->clients as $client) {
            // The sender is not the receiver, send to each client connected

            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}