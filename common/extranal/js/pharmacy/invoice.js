"use strict";
$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});


$('#download').click(function () {
    "use strict";
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.rect(10, 10, 150, 160, "F");
    pdf.addHTML($('#invoice'), function () {
        pdf.save('invoice_id_<?php echo $payment->id; ?>.pdf');
    });
});



