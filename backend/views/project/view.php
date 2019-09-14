<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Project;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var \yii\data\ActiveDataProvider $taskDataProvider */
/* @var  \backend\models\TaskSearch $taskSearchModel*/

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label'=>'Автор',
                'value'=> function(Project $model) {
                    return $model->author->username;

                }
            ],
            [
                'label'=>'Статус',
                'value'=> function(Project $model) {
                    return $model->projectStatus->name;

                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $taskDataProvider,
        'filterModel' => $taskSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'author_id',
            'status_id',
            //'priority_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
