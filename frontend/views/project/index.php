<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function(\common\models\Project $model) {
                    return Html::a($model->name, ['project/view', 'id'=>$model->id]);
                }
            ],
            [
                'attribute' => 'project_status_id',
//                'filter' => \common\models\ProjectStatus::getProjectStatusName(),
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ProjectStatus::find()->asArray()->all(), 'id', 'name'),
                'value'=> function(\common\models\Project $model) {
                    return $model->projectStatus->name;
//                    return \common\models\ProjectStatus::getProjectStatusName()[$model->project_status_id];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

        ],
    ]); ?>
<?=\common\widgets\chatWidget\ChatWidget::widget();?>

</div>
