"use strict";
// var myEditor1;
// var myEditor2;
// var myEditor3;
// $(document).ready(function () {

//     ClassicEditor
//         .create(document.querySelector('#editor1'))
//         .then(editor1 => {
//             editor1.ui.view.editable.element.style.height = '200px';
//             myEditor1 = editor1;
//         })
//         .catch(error => {
//             console.error(error);
//         });

//     ClassicEditor
//         .create(document.querySelector('#editor2'))
//         .then(editor2 => {
//             editor2.ui.view.editable.element.style.height = '200px';
//             myEditor2 = editor2;
//         })
//         .catch(error => {
//             console.error(error);
//         });

//     ClassicEditor
//         .create(document.querySelector('#editor3'))
//         .then(editor3 => {
//             editor3.ui.view.editable.element.style.height = '200px';
//             myEditor3 = editor3;
//         })
//         .catch(error => {
//             console.error(error);
//         });


// });

tinymce.init({
    selector: '#editor1',
    height: 200,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    branding: false,
    promotion: false
});
tinymce.init({
    selector: '#editor2',
    height: 200,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    branding: false,
    promotion: false
});
tinymce.init({
    selector: '#editor3',
    height: 200,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    branding: false,
    promotion: false
});


$(document).ready(function () {
    "use strict";
    var selected = $('#my_select1_disabled').find('option:selected');
    var unselected = $('#my_select1_disabled').find('option:not(:selected)');
    selected.attr('data-selected', '1');
    $.each(unselected, function (index, value1) {
        "use strict";
        if ($(this).attr('data-selected') == '1') {
            var value = $(this).val();
            var res = value.split("*");

            var id = res[0];
            $('#med_selected_section-' + id).remove();


        }
    });


    var count = 0;
    $.each($('select.medicinee option:selected'), function () {
        "use strict";
        var value = $(this).val();
        var res = value.split("*");

        var id = res[0];

        var med_id = res[0];
        var med_name = res[1];
        var dosage = $(this).data('dosage');
        var frequency = $(this).data('frequency');
        var days = $(this).data('days');
        var instruction = $(this).data('instruction');
        if ($('#med_id-' + id).length) {

        } else {

            $(".medicine").append('<section id="med_selected_section-' + med_id + '" class="med_selected col-md-12" style="background-color: #f2f2f2; padding: 10px; margin-bottom: 10px;">\n\
                <div class="form-group medicine_sect">\n\
                   <div class="row">\n\
                       <div class="col-md-3">\n\
                           <label>Medicine</label>\n\
                           <input class="medi_div form-control form-control-lg" style="font-weight: bold;" readonly name="med_id[]" value="' + med_name + '" placeholder="" required>\n\
                           <input type="hidden" id="med_id-' + id + '" class="medi_div" name="medicine[]" value="' + med_id + '" placeholder="" required>\n\
                       </div>\n\
                       <div class="col-md-3">\n\
                           <label>Dosage</label>\n\
                           <input class="state medi_div form-control form-control-lg" name="dosage[]" value="' + dosage + '" placeholder="100 mg" required>\n\
                       </div>\n\
                       <div class="col-md-3">\n\
                           <label>Frequency</label>\n\
                           <input class="potency medi_div sale form-control form-control-lg" id="salee' + count + '" name="frequency[]" value="' + frequency + '" placeholder="1 + 0 + 1" required>\n\
                       </div>\n\
                       <div class="col-md-3">\n\
                           <label>Days</label>\n\
                           <input class="potency medi_div quantity form-control form-control-lg" id="quantity' + count + '" name="days[]" value="' + days + '" placeholder="7 days" required>\n\
                       </div>\n\
                   </div>\n\
                   <div class="row">\n\
                       <div class="col-md-12">\n\
                           <label>Instruction</label>\n\
                           <input class="potency medi_div quantity form-control form-control-lg" id="quantity' + count + '" name="instruction[]" value="' + instruction + '" placeholder="After Food" required>\n\
                       </div>\n\
                   </div>\n\
               </div>\n\
               <div class="del col-md-1"></div>\n\
           </section>');
        }
    });
}
);


$(document).ready(function () {
    "use strict";
    // First unbind any existing handlers to prevent duplicates
    $("#my_select1_disabled").off('select2:select select2:unselect change');
    
    // Single handler for select2 changes
    $("#my_select1_disabled").on('select2:select select2:unselect change', function (e) {
        var count = 0;
        
        // Handle medicine selection/deselection
        var selected = $('#my_select1_disabled').find('option:selected');
        var unselected = $('#my_select1_disabled').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        
        // Remove unselected medicines
        $.each(unselected, function (index, value1) {
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");
                var id = res[0];
                $('#med_selected_section-' + id).remove();
                $('#interaction_warning-' + id).remove();
            }
        });

        // Add selected medicines
        $.each(selected, function () {
            var value = $(this).val();
            var res = value.split("*");
            var id = res[0];
            var med_id = res[0];
            var med_name = res[1];
            var dosage = $(this).data('dosage');
            var frequency = $(this).data('frequency');
            var days = $(this).data('days');
            var instruction = $(this).data('instruction');

            if ($('#med_id-' + id).length) {
                // Medicine already added
            } else {
                $(".medicine").append('\n\
                    <section class="med_selected" id="med_selected_section-' + med_id + '" style="background-color: #f2f2f2; padding: 10px; margin-bottom: 10px;">\n\
                        <div class="form-group medicine_sect">\n\
                            <div class="row">\n\
                                <div class="col-md-3">\n\
                                        <label> Medicine </label>\n\
                                        <input class = "medi_div form-control form-control-lg" style="font-weight: bold;" readonly name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
                                        <input type="hidden" class = "medi_div" id="med_id-' + id + '" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
                                </div>\n\
                                <div class="col-md-3">\n\
                                        <label>Dosage </label>\n\
                                        <input class = "state medi_div form-control form-control-lg" name = "dosage[]" value = "" placeholder="100 mg" required>\n\
                                </div>\n\
                                <div class="col-md-3">\n\
                                        <label>Frequency</label>\n\
                                        <input class = "potency medi_div sale form-control form-control-lg" id="salee' + count + '" name = "frequency[]" value = "" placeholder="1 + 0 + 1" required>\n\
                                </div>\n\
                                <div class="col-md-3">\n\
                                    <label>Days </label>\n\
                                    <input class = "potency medi_div quantity form-control form-control-lg" id="quantity' + count + '" name = "days[]" value = "" placeholder="7 days" required>\n\
                                </div>\n\
                            </div>\n\
                            <div class="row">\n\
                                <div class=col-md-12 d-flex flex-column>\n\
                                    <label>Instructions</label>\n\
                                    <input class = "potency medi_div quantity form-control form-control-lg" id="quantity' + count + '" name = "instruction[]" value = "" placeholder="After Food" required>\n\
                                </div>\n\
                            </div>\n\
                            </div>\n\
                        <div class="del col-md-1"></div>\n\
                    </section>');
            }
        });

        // Debounce the drug interaction check
        clearTimeout(window.drugInteractionTimer);
        window.drugInteractionTimer = setTimeout(function() {
            // Get all selected medicine names
            var medicine_names = [];
            selected.each(function() {
                var value = $(this).val();
                var res = value.split("*");
                var med_name = res[1];
                if (med_name && !medicine_names.includes(med_name)) {
                    medicine_names.push(med_name);
                }
            });

            // Remove old warnings first
            $('.drug-interaction-warning').remove();
            $('.drug-interactions-column').empty();

            // Check for drug interactions if more than one medicine is selected
            if (medicine_names.length > 1) {
                $.ajax({
                    url: 'prescription/checkDrugInteractions',
                    type: 'POST',
                    data: {medicines: medicine_names},
                    success: function(response) { 
                        try {
                            console.log('Raw Drug Interaction Response:', response);
                            console.log('Response Type:', typeof response);
                            
                            // Handle both string and object responses
                            var interactions = typeof response === 'string' ? JSON.parse(response) : response;
                            
                            // Extract interactions array from response object
                            if (interactions.interactions) {
                                var warnings = interactions.warnings || [];
                                interactions = interactions.interactions;
                            }
                            
                            console.log('Parsed Interactions:', interactions);
                            
                            // Show new warnings if there are interactions
                            if (interactions && interactions.length > 0) {
                                console.log('Number of interactions found:', interactions.length);
                                
                                // Show compact warning near medicine selection
                                var compactWarning = '<div class="drug-interaction-warning alert alert-danger mt-3 p-3">' +
                                    '<div class="d-flex align-items-center">' +
                                    '<i class="fas fa-exclamation-triangle fs-4 me-3 text-danger"></i>' +
                                    '<div>' +
                                    '<strong class="fs-5 d-block mb-1">Drug Interaction Warning</strong>' +
                                    '<span>' + interactions.length + ' drug interaction' + 
                                    (interactions.length > 1 ? 's' : '') + ' detected between your selected medications.</span>' +
                                    '<div class="mt-2"><a href="#interaction_details" class="btn btn-sm btn-outline-danger">View Details</a></div>' +
                                    '</div></div>' +
                                    '</div>';
                                
                                // Remove any existing warnings
                                $('.drug-interaction-warning').remove();
                                
                                // Add the warning once to the dedicated container
                                $('#drug_interaction_warning_container').html(compactWarning);
                                
                                // Create detailed interaction cards for the details section
                                var detailsHtml = '';
                                
                                // Add each interaction pair in a card
                                interactions.forEach(function(interaction, index) {
                                    detailsHtml += '<div class="card mb-3 border-danger shadow-sm">' +
                                        '<div class="card-header bg-danger text-white py-2 px-3">' +
                                        '<h6 class="mb-0"><i class="fas fa-pills me-2"></i>' + 
                                        interaction.medicines[0] + ' + ' + interaction.medicines[1] + '</h6>' +
                                        '</div>' +
                                        '<div class="card-body py-3 px-4">' +
                                        '<div class="interaction-details">';
                                    
                                    // HTML content can be directly added without wrapping in a <p> tag
                                    detailsHtml += interaction.interaction;
                                    
                                    if (interaction.source) {
                                        detailsHtml += '<div class="mt-3"><small class="text-muted d-flex align-items-center">' + 
                                            '<i class="fas fa-info-circle me-1"></i>Source: ' + 
                                            interaction.source + '</small></div>';
                                    }
                                    
                                    detailsHtml += '</div></div></div>';
                                });
                                
                                // Add warning to the dedicated drug interactions column
                                $('.drug-interactions-column').html(detailsHtml);
                                
                                // Make sure the details container is visible
                                $('#interaction_details').show();
                                
                                // Add smooth scroll to the details
                                $('a[href="#interaction_details"]').on('click', function(event) {
                                    event.preventDefault();
                                    $('html, body').animate({
                                        scrollTop: $($(this).attr('href')).offset().top - 100
                                    }, 500);
                                });
                            }
                        } catch (e) {
                            console.error('Error processing drug interactions:', e);
                            console.log('Raw response:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Drug interaction AJAX error:', error);
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                    }
                });
            }
        }, 500); // 500ms debounce
    });
});


$(document).ready(function () {
    "use strict";
    $("#patientchoose").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
    $("#doctorchoose").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
    $("#doctorchoose1").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorInfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });



});

$(document).ready(function () {
    "use strict";
    $('#my_select1').select2({
        multiple: true,
        placeholder: select_medicine,
        allowClear: true,
        closeOnSelect: true,
        ajax: {
            url: 'medicine/getMedicinenamelist',
            dataType: 'json',
            type: "post",
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {

                params.page = params.page || 1;

                return {
                    results: data,
                    newTag: true,
                    pagination: {
                        more: (params.page * 1) < data.total_count
                    }
                };
            },
            cache: true
        },
    });
});

$(document).ready(function () {
    "use strict";
    $("#my_select1_disabled").select2({
        placeholder: select_medicine,
        multiple: true,
        allowClear: true,
        ajax: {
            url: 'medicine/getMedicineListForSelect2',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
});