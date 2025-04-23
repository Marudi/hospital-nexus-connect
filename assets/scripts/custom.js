"use strict";
function alert_float(type,title,message,icon="", timeout) {
    var aId, el;
    aId = $("body").find('.float-alert').length;
    var height = 5;
    $("body").find('.float-alert').each(function(index, el) {
        height += parseInt($(this).height())+25;
    });
    aId++;

    aId = 'alert_float_' + aId;
    el = $(`<div id="toast-container" class="toast-top-right">`, {
        "id": aId,        
        "class": "animated fadeInRight col-xs-10 col-sm-3 toast toast-" + type,
        "style" : "top: calc(5% + "+height+"px);"
    });
    if (type=="csrfkey" || type=="csrfvalue") {
        return false;
    }
    if (type!="success" && type!="info" && type!="warning") {
        type = "error";
    }
    if (icon=="") {
        if (type=="success") {
            icon = "icon ion-ios-checkmark";
        }
        if (type=="error") {
            icon = "icon ion-ios-close";
        }
        if (type=="info") {
            icon = "icon ion-ios-information";
        }
        if (type=="warning") {
            icon = "icon ion-alert-circled";
        }
    }
    el.append('<div class="toast toast-'+type+'" aria-live="assertive" style=""><div class="toast-title">'+title+'</div><div class="toast-message">' + message + '</div></div></div>');    
    $("body").append(el);
    timeout = timeout ? timeout : 3500
    setTimeout(function() {
        $('#toast-container').hide('fast', function() {
            $('#toast-container').remove();
        });
    }, timeout);
}

$('#table').on('click','._delete', function () {
    return confirm('Are you sure you want to perform this action?');
});