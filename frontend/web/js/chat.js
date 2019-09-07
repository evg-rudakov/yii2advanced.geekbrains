let chat = new WebSocket('ws://yii2advanced.geekbrains:8080');
let username = $('.js-username').val();
chat.onmessage = function (e) {
    $('#response').text('');
    console.log(e);
    let response = JSON.parse(e.data);
    $('#chat').append('<div><b>' + response.username + '</b>: ' + response.message + '</div>');
    $('#chat').scrollTop = $('#chat').height;
};

chat.onopen = function (e) {
    $('#response').text("Connection established! Please, set your username.");
};
$('#send').click(function () {
    chat.send(JSON.stringify({
            'username': username,
            'message': $('#message').val()
        })
    );
    $('#message').val('');
});
