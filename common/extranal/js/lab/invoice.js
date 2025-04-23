"use strict";
$('#download_button').on('click', '#download', function () {
    "use strict";
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addHTML($('#lab'), function () {
        pdf.save('lab_id_' + lab_id + '.pdf');
    });
});
$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});