<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 17:52
 */

namespace console\controllers;


use console\components\SocketServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

class SocketController extends Controller
{

    /**
     * Запуск Socket-сервера
     * @param int $port
     */
    public function actionStart($port = 8080)
    {
        $server = IoServer::factory(new HttpServer(new WsServer(new SocketServer())), $port);
        echo "Сервер запущен \r\n";
        $server->run();
        echo "Сервер Остановлен \r\n";
    }

}