<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 17:43
 */

namespace console\components;


use common\models\ChatLog;
use console\models\ChatMessage;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;
    protected $message;

    public function __construct()
    {
        // Для хранения технической информации об присоединившихся
        // клиентах используется технология SplObjectStorage, встроенная в PHP
        $this->clients = new \SplObjectStorage();

    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $conn->send('join-user');
        $this->sendWelcomeMessage($conn);
        $conn->send('history');
        echo "New connection! ({$conn->resourceId})\n";
    }


    private function sendWelcomeMessage(ConnectionInterface $conn)
    {
        $conn->send(json_encode([
            'message' => 'Чат студентов geekbrains.ru',
            'username' => 'System',
            'created_datetime' => \Yii::$app->formatter->asDatetime(time())
        ]));
    }

    public function sendHistory(ConnectionInterface $from, $chatMessage)
    {
        $project_id = $chatMessage['project_id'] ?? null;
        $task_id = $chatMessage['task_id'] ?? null;
        $chatLogs = ChatLog::find()->andWhere([
            'project_id' => $project_id,
            'task_id' => $task_id
        ])->limit(10)->orderBy(['created_at' => SORT_ASC])->all();

        foreach ($chatLogs as $chatLog) {
            $from->send($chatLog->toJson());
        }

    }

    public function onMessage(ConnectionInterface $from, $jsonMsg)
    {
        $message = json_decode($jsonMsg, true);
        $action = $message['action'] ?? null;

        if (isset($action)) {
            if ($action === 'history') {
                $this->sendHistory($from, $message);
            } elseif ($action === 'join-user') {
                $this->sendJoinUserMessage($message);
            }
        } else {
            $this->sendChatMessageToAll($message);
        }
    }

    private function sendChatMessageToAll($message)
    {
        $chatLog = new ChatLog($message);

        $chatLog->save();

        foreach ($this->clients as $client) {
            $client->send($chatLog->toJson());
        }
    }

    private function sendJoinUserMessage($message)
    {
        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'message' => 'Пользователь ' . $message['username'] . ' присоединился к чату',
                'username' => 'System',
                'created_datetime' => \Yii::$app->formatter->asDatetime(time())
            ]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getTraceAsString()}\n";
        $conn->close();
    }

}