<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 12:34
 */

namespace console\controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use console\components\SocketServer; //не забудьте поменять, если отличается

class SocketController extends \yii\console\Controller
{
    public function actionStartSocket($port = 8080)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer()
                )
            ),
            $port
        );
        $server->run();
    }
}