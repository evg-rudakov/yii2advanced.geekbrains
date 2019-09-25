let username = $('meta[name="chat-widget-username"]').attr('content');
let project_id = $('meta[name="chat-widget-project-id"]').attr('content');
let task_id = $('meta[name="chat-widget-task-id"]').attr('content');
let chat = new WebSocket('ws://yii2advanced.geekbrains:8080');

chat.onmessage = function (e) {
    debugger;
    if (e.data === 'history') {
        chat.send(JSON.stringify({
            'action': 'history',
            'project_id': project_id,
            'task_id': task_id,
            'username': username
        }));
    } else if (e.data === 'join-user') {
        chat.send(JSON.stringify({
            'action': 'join-user',
            'project_id': project_id,
            'task_id': task_id,
            'username': username
        }));
    } else {
        sendMessageToChat(e);
    }

};



function sendMessageToChat(e){
    $('#response').text('');
    console.log(e);
    let response = JSON.parse(e.data);
    $('.js-messages-content').append('<div>' + response.created_datetime + ' <b>' + response.username + '</b>: ' + response.message + '</div>');
}

chat.onopen = function (e) {
    // chat.send(JSON.stringify({
    //     'init': true,
    //     'project_id' : project_id,
    //     'task_id': task_id,
    //     'username': username
    // }));
};

chat.onclose = function(e) {
    $('.js-messages-content').append('<div>Соеденение закрыто</div>');
};

$('#send').click(function () {
    let message = $('#message').val();
    chat.send(JSON.stringify({
            'username': username,
            'message': message,
            'project_id': project_id,
            'task_id': task_id
        })
    );
    $('#message').val('');
});
$(document).on('click', '.js-hide', function () {
    $('.js-chat-content').hide();
    $('.js-show').show();
});
$(document).on('click', '.js-show', function() {
    $('.js-chat-content').show();
    $('.js-show').hide();

});
