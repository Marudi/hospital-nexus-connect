"use strict";
$(document).ready(function () {
    "use strict";
    if (hospital_id !== null) {
        if (hospital_package === null) {

            $('.pos_client').show();
        } else {
            $('.pos_client').hide();

        }
    } else {

        $('.pos_client').hide();
    }
    $(document.body).on('change', '#package_select', function () {
        "use strict";
        var v = $("select.pos_select option:selected").val()
        if (v == '') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

});