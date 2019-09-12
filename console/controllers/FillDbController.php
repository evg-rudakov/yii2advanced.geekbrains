<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 11/09/2019
 * Time: 15:39
 */

namespace console\controllers;


use common\models\ProjectStatus;
use common\models\TaskPriority;
use common\models\TaskStatus;
use yii\console\Controller;

class FillDbController extends Controller
{

    public function actionInitFill()
    {
        foreach (TaskStatus::getStatusName() as $id => $name) {
            $taskStatus = TaskStatus::findOne($id);
            if (!isset($taskStatus)) {
                $taskStatus = new TaskStatus();
                $taskStatus->id = $id;
            }
            $taskStatus->name = $name;
            if ($taskStatus->save()) {
                echo "TaskStatus.id={$id} with name={$name} is created \r\n";
            } else {
                var_dump($taskStatus->id);
                var_dump($taskStatus->errors);
                die();
            }
        }

        foreach (TaskPriority::getPriorityName() as $id => $name) {
            $taskPriority = TaskPriority::findOne($id);

            if (!isset($taskPriority)) {
                $taskPriority = new TaskPriority();
                $taskPriority->id = $id;
            }

            $taskPriority->name = $name;
            if ($taskPriority->save()) {
                echo "TaskPriority.id={$id} with name={$name} is created \r\n";
            } else {
                var_dump($taskPriority->id);
                var_dump($taskPriority->errors);
                die();
            }
        }

        foreach (ProjectStatus::getProjectStatusName() as $id => $name) {
            $projectStatus = ProjectStatus::findOne($id);

            if (!isset($projectStatus)) {
                $projectStatus = new ProjectStatus();
                $projectStatus->id = $id;
            }

            $projectStatus->name = $name;
            if ($projectStatus->save()) {
                echo "projectStatus.id={$id} with name={$name} is created \r\n";
            } else {
                var_dump($projectStatus->id);
                var_dump($projectStatus->errors);
                die();
            }
        }
    }


}