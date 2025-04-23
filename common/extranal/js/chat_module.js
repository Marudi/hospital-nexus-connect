"use strict";

$('.caSendBtn').on('click', function () {
    "use strict";
    let chat = $('.chatInput').val();
    let receiverId = $('#receiverId').val();
    if (chat.trim()) {
        $.ajax({
            url: 'chat/sendChat?chat=' + chat + '&receiverId=' + receiverId,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                console.log('success');
                $('.chatBox').append('<span class="chat-sender">' + chat + '</span>');
                $('.chatInput').val('');
            }
        });
    }
})


$('.chatInput').on('keypress', function (e) {
    "use strict";
    if (e.which == 13) {
        let chat = $('.chatInput').val();
        let receiverId = $('#receiverId').val();
        if (chat.trim()) {
            $.ajax({
                url: 'chat/sendChat?chat=' + chat + '&receiverId=' + receiverId,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    "use strict";
                    console.log('success');
                    $('.chatBox').append('<span class="chat-sender">' + chat + '</span>');
                    $('.chatInput').val('');
                }
            });
        }
    }
});


$(document).on('click', '.ca-chat-btn', function () {
    "use strict";
    if ($(this).hasClass('newChat')) {
        $(this).removeClass('newChat');
    }

    $('.ca-chat-btn').removeClass('ca-selected-chat');
    $(this).addClass('ca-selected-chat');
    let id = $(this).data('id');
    $.ajax({
        url: 'chat/changeChat?id=' + id,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            "use strict";
            $('.chatBox').empty();
            $('.chatBox').append(response.chats);
            $('#receiverId').val(id);
            $('#lastMessageId').val(response.lastMessageId);
            $('#recentMessageId').val(response.recentId);
            $('.chatInfo').empty();
            $('.chatInfo').append(response.user);
        }
    });
})

var lastScrollTop = 0;
$('.chatBox').scroll(function (event) {
    "use strict";
    var st = $(this).scrollTop();
    let receiverId = $('#receiverId').val();
    let lastMessageId = $('#lastMessageId').val();
    if (st > lastScrollTop) {
        console.log('besi: ' + st);
    } else {

        if (lastMessageId !== 0 && st === 0) {
            $.ajax({
                url: 'chat/getOldMessage?receiverId=' + receiverId + '&lastMessageId=' + lastMessageId,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (response) {
                    console.log('success');
                    $('.chatBox').prepend(response.chats);
                    $('#lastMessageId').val(response.lastMessageId);
                }
            });
        }
    }
    lastScrollTop = st;
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);

    setInterval(function () {
        "use strict";
        let id = $('#receiverId').val();
        let recentMessageId = $('#recentMessageId').val();
        $.ajax({
            url: 'chat/checkChat?receiverId=' + id + '&recentId=' + recentMessageId,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            if ($('#receiverId').val() == id) {
                $('#recentMessageId').val(response.recentId);
                $('.chatBox').append(response.currentChats);
                $('#chattersBlock').empty();
                $('#chattersBlock').append(response.html);

            }
        });
    }, 3000);


});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);

    setInterval(function () {
        "use strict";
        let id = $('#receiverId').val();
        let recentMessageId = $('#recentMessageId').val();
        $.ajax({
            url: 'chat/checkChat?receiverId=' + id + '&recentId=' + recentMessageId,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                if ($('#receiverId').val() == id) {
                    $('#recentMessageId').val(response.recentId);
                    $('.chatBox').append(response.currentChats);
                    $('#chattersBlock').empty();
                    $('#chattersBlock').append(response.html);

                }
            }
        });
    }, 3000);


});


$(document).on('keyup', '#searchChat', function () {
    "use strict";
    let search = $('#searchChat').val();
    $.ajax({
        url: 'chat/findChatPerson?search=' + search,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            "use strict";
            $('#adminChatters').empty();
            $('#employeeChatters').empty();

            $('#adminChatters').append(response.admin);
            $('#employeeChatters').append(response.employee);
        }
    });
});


