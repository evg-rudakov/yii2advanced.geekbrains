<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 21/09/2019
 * Time: 11:22
 */
?>
    <div class="chat-popup form-container">
        <div class="js-chat-content">
            <h1>Chat</h1>
            <div class="js-messages-content"></div>

            <label for="msg"><b>Message</b></label>
            <textarea id="message" placeholder="Type message.." name="msg" required></textarea>

            <button type="button" id="send" class="btn">Send</button>
            <button type="button" class="btn cancel js-hide">Hide</button>
        </div>
        <button type="button" style="display: none;" class="btn btn-primary js-show">Show</button>
    </div>

<?php
?>