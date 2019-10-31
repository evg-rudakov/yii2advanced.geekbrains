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
use yii\base\InvalidArgumentException;

class SocketServer implements MessageComponentInterface
{
    protected $clients;
    /** @var ConnectionInterface */
    protected $currentConnection;

    public function __construct()
    {
        // Для хранения технической информации об присоединившихся
        // клиентах используется технология SplObjectStorage, встроенная в PHP
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->currentConnection = $conn;
        $this->sendWelcomeMessage();
        var_dump("New connection! ({$conn->resourceId})");
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        var_dump($message);
        var_dump('clients:' . count($this->clients));

        $message = json_decode($message, true);

        try {
            $type = (int)$message['type'];
        } catch (\Throwable $exception) {
            throw new InvalidArgumentException('No type');
        }

        if ($type === ChatLog::TYPE_CHAT_MESSAGE) {
            $this->sendMessageToAll($message);
        } elseif ($type === ChatLog::TYPE_HELLO_MESSAGE) {
            $this->sendClientEnteredMessage($message);
        } elseif ($type===ChatLog::TYPE_SHOW_HISTORY_MESSAGE) {
            $this->showHistory($message);
        }

    }
    private function showHistory($message)
    {
        foreach (ChatLog::findChatMessages($message)->each() as $chatMessage) {
            $this->currentConnection->send($chatMessage->asJson());
        }

    }

    private function sendMessageToAll(array $message)
    {
        $message['created_datetime'] = \Yii::$app->formatter->asDatetime(time());

        ChatLog::saveLog($message);

        foreach ($this->clients as $client) {

            $client->send(json_encode($message));
        }
    }

    private function sendClientEnteredMessage(array $message)
    {
        $clientUserName = $message['username'];
        $message['username'] = 'system';
        $message['message'] = "$clientUserName зашел в чат";

        $this->sendMessageToAll($message);
    }

    private function sendWelcomeMessage()
    {
        $message = [
            'created_datetime' => \Yii::$app->formatter->asDatetime(time()),
            'username' => 'system',
            'message' => 'Добро пожаловать в чат geekbrains.ru'
        ];

        $this->currentConnection->send(json_encode($message));
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