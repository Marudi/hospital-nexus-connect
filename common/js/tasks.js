"use strict";
var TaskList = function () {
"use strict";
    return {

        initTaskWidget: function () {
			$('input.list-child').on('change', function () {
				if ($(this).is(':checked')) { 
					$(this).parents('li').addClass("task-done"); 
				} else { 
					$(this).parents('li').removeClass("task-done"); 
				}
			}); 
        }

    };

}();