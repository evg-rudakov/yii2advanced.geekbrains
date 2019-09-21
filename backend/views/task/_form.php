<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
/* @var $activeUsers \common\models\User[] */
/* @var $projects \common\models\Project[] */

?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author_id')->dropDownList($activeUsers) ?>

    <?= $form->field($model, 'executor_id')->dropDownList($activeUsers) ?>

    <?= $form->field($model, 'accountable_id')->dropDownList($activeUsers) ?>

    <?= $form->field($model, 'status_id')->dropDownList(\common\models\TaskStatus::getStatusName()) ?>

    <?= $form->field($model, 'priority_id')->dropDownList(\common\models\TaskPriority::getPriorityName()) ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
