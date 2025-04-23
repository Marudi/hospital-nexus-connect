<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <link href="common/css/bootstrap.min.css"  rel="stylesheet" type="text/css" media="screen" >
        <link href="common/css/bootstrap-reset.css"  rel="stylesheet" type="text/css" media="screen" >
        external css
        <link href="common/assets/fontawesome5pro/css/all.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/datatables.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css"  rel="stylesheet" type="text/css" media="screen"  />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css"  rel="stylesheet" type="text/css" media="screen"  />


        <link href="common/css/style.css"  rel="stylesheet" type="text/css" media="screen" >

        <link  rel="stylesheet" type="text/css" media="screen"  href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css"  rel="stylesheet" type="text/css" media="screen"  media="print">
        <link href="common/assets/fullcalendar/fullcalendar.css"  rel="stylesheet" type="text/css" media="screen" >
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/select2/css/select2.min.css"/>
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/css/lightbox.css"/>
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link  rel="stylesheet" type="text/css" media="screen"  type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <link  rel="stylesheet" type="text/css" media="screen"  href="common/css/bootstrap-select.min.css">
        <link  rel="stylesheet" type="text/css" media="screen"  href="common/css/bootstrap-select-country.min.css">
        <link  rel="stylesheet" type="text/css" media="screen"  href="common/extranal/toast.css">
         Google Fonts 

        <link href="common/extranal/css/medical_history_calendar_modal.css"  rel="stylesheet" type="text/css" media="screen" >


        <link href="common/css/style-responsive.css"  rel="stylesheet" type="text/css" media="screen"  />

    </head>
    <style>
        body {
            print-color-adjust: exact;
        }
        
        hr {
            border-top: 1px solid #000 !important;
            width: 100%;
        }

        h1, h3, h2, h4 {
            margin: 0px;
        }

        p {
            margin: 3px 0px;
            font-size: .85rem;
        }

        /*        #footer {
                    position: absolute;
                    bottom: 10px;
                    right: 20;
                    left: 20;
                }*/
        
        .flex-wrapper {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
  justify-content: flex-start;
}

#footer {
  margin-top: auto;
}

body {
            font-family: 'Open Sans', sans-serif;
        }

        h1, h2, h3, h4, h5, h6, p {
            font-family:  'Open Sans', sans-serif !important;
        }
        
        .table-qr-hr {
            margin-top: 10px !important;
            margin-bottom: 20px !important;
        }
    </style>
    <body>
        <div class="flex-wrapper" style="border: 1px solid #000;">
            <?php $patient = $this->db->get_where('patient', array('id' => $lab->patient))->row(); ?>
            <table style="width: 100%">
                <tr>
                    <td>
                        <img alt="" src="<?php echo site_url($this->settings_model->getSettings()->logo); ?>" width="200" height="100">
                    </td>
                    <td>
                        <h2 style="margin-bottom: 10px;"><?php echo $settings->title; ?></h2>
                        <h4 style="margin-bottom: 10px;"><?php echo $settings->address; ?></h4>
                        <h3><?php echo $settings->phone; ?></h3>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="width: 50%">
                                    PID: <?php echo $patient->id; ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Name: <?php echo $patient->name; ?>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                $age = explode('-', $patient->age);
                                if (count($age) == 3) {
                                    ?>
                                    <td colspan="2">Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                                <?php } else { ?>
                                    <td colspan="2">Age: </td>
                                <?php }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Gender: <?php echo $patient->sex; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr class="table-qr-hr">
            <table style="width: 100%">
                <tr>
                    <td style="width: 50%; text-align: center;">
                        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                    </td>
                    <td style="width: 50%; text-align: center;">
                        <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->id; ?>&print=true" />
                    </td>
                </tr>
            </table>
            <hr class="table-qr-hr">
            <div style="padding: 10px">
                <?php echo $lab->report; ?>
            </div>
            <div id="footer" style="padding: 10px;">
                <img src="https://visme.co/blog/wp-content/uploads/2021/06/header-53.png" width="100%" height="100px">
                <hr>
                <div>
                    <p>Entered By: (ELECTRONIC SIGNATURE)<br><?php if($lab->reported_by) { echo $this->db->get_where('users', array('id' => $lab->reported_by))->row()->username; } ?></p>
                </div>
                <p>
                    <?php
                    if ($lab->updated_on) {
                        echo "Updated on Time: " . date('d M Y h:s A');
                    }
                    ?>
                </p>
            </div>
        </div>
    </body>
</html>