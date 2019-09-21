<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $taskDataProvider \yii\data\ActiveDataProvider */
/* @var $taskSearch \frontend\models\TaskSearch */

$this->title = 'Задачи проекта '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= \yii\grid\GridView::widget([
        'filterModel' => $taskSearch,
        'dataProvider' => $taskDataProvider,
        'columns' => [
            'id',
            'name',
            'created_at:datetime',
            'description',
            'status.name',
            'priority.name',
            'author.email',
        ]
    ]) ?>
    <?=\common\widgets\chatWidget\ChatWidget::widget(['project_id' => $model->id]);?>



</div>
