<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $activeUsers \common\models\User[] */
/* @var $projects \common\models\Project[] */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'activeUsers' => $activeUsers,
        'projects' => $projects,
    ]) ?>

</div>
