   "use strict";
$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function() {
    "use strict";

    $('.other').hide();
    $(".radio_button").on("change", "input[type=radio][name=radio]", function() {
        if (this.value === 'other') {
            $('.other').show();
        } else {
            $('.other').hide();
        }
    });

});
$(document).ready(function() {
    "use strict";

    $('.single_patient').hide();
    $('input[type=radio][name=radio]').change(function() {
        if (this.value === 'single_patient') {
            $('.single_patient').show();
        } else {
            $('.single_patient').hide();
        }
    });

});