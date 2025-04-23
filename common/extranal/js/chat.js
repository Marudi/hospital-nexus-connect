"use strict";
$(document).ready(function () {
    "use strict";
    $.ajax({
        url: 'chat/checkChat2',
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            $('#chatCount').empty();
            let count = (response.unreads).length;

            $('#chatCount').append(count);
        }
    })
    setInterval(function () {
        $.ajax({
            url: 'chat/checkChat2',
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                $('#chatCount').empty();
                let count = (response.unreads).length;
                
                $('#chatCount').append(count);
            }
        });
    }, 3000);
});