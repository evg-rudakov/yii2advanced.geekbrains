<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 21/09/2019
 * Time: 11:22
 */

?>
<div id="chat" style="min-height: 100px;"></div>
<div id="response" style="color:#D00"></div>
<div class="row">
    <div class="col-lg-9">
        <?= \yii\helpers\Html::textInput('message', '', ['id' => 'message', 'class' => 'form-control']) ?>
    </div>

    <div class="col-lg-3">
        <?= \yii\helpers\Html::button('Отправить', ['id' => 'send', 'class' => 'btn btn-primary']) ?>
    </div>
</div>

<?= \yii\helpers\Html::hiddenInput('username', $username, ['class' => 'js-username']) ?>
