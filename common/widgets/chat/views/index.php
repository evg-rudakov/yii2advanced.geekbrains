<?php
/** @var string $username  */
/** @var \yii\web\View $this $a */
$a=1;

?>
<div class="chat-popup form-container">
    <div class="js-chat-content">
        <h1>Chat</h1>
        <div class="js-messages-content messages-content"></div>

        <label for="msg"><b>Message</b></label>
        <textarea id="message" placeholder="Type message.." name="msg" required></textarea>

        <button type="button" id="send" class="btn">Send</button>
        <button type="button" class="btn cancel js-hide">Hide</button>
    </div>
    <button type="button" style="display: none;" class="btn btn-primary js-show">Show</button>
</div>

<?= \yii\helpers\Html::hiddenInput('username', $this->context->username, ['class' => 'js-username']) ?>
<?= \yii\helpers\Html::hiddenInput('task_id', $this->context->task_id, ['class' => 'js-task_id']) ?>
<?= \yii\helpers\Html::hiddenInput('project_id', $this->context->project_id, ['class' => 'js-project_id']) ?>

