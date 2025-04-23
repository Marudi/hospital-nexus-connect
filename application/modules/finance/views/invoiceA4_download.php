<head>
    <base href="<?php echo base_url(); ?>">
    <link href="common/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet" type="text/css" media="screen">

    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css" rel="stylesheet" type="text/css" media="screen" />


    <link href="common/css/style.css" rel="stylesheet" type="text/css" media="screen">

    <link rel="stylesheet" type="text/css" media="screen" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
    <link href="common/css/invoice-print.css" rel="stylesheet" type="text/css" media="screen" media="print">
    <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/css/lightbox.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" media="screen" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" media="screen" href="common/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="common/css/bootstrap-select-country.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="common/extranal/toast.css">


    <link href="common/extranal/css/medical_history_calendar_modal.css" rel="stylesheet" type="text/css" media="screen">


    <link href="common/css/style-responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <!--        <link href="common/extranal/css/finance/print_and_design_A4.css" rel="stylesheet" />-->

</head>
<style>
    body {
        print-color-adjust: exact;
    }

    hr {
        border-top: 1px solid #000 !important;
        width: 100%;
    }

    h1,
    h3,
    h2,
    h4,
    h5,
    h6 {
        margin: 0px;
    }

    p {
        margin: 3px 0px;
        font-size: .85rem;
    }



    .flex-wrapper {
        display: flex;
        /*            min-height: 100vh;*/
        flex-direction: column;
        justify-content: flex-start;
    }

    #footer {
        margin-top: auto;
    }

    /*        .panel {
            border: 0px solid #5c5c47;
            background: #fff !important;
            height: 100%;
            margin: 20px 5px 5px 5px;
            border-radius: 0px !important;
            min-height: 700px;
        }*/

    .panel-body {
        padding: 15px 15px !important;
    }

    .table-qr-hr {
        margin-top: 10px !important;
        margin-bottom: 20px !important;
    }

    .info_text {
        font-size: 11px;
    }

    .control_label {
        font-size: 12px;
        width: 50px;
    }

    .reportBlock table {
        border: 1px solid black;
    }

    .reportBlock table td {
        border: 1px solid black;
    }

    .image_bar {
        vertical-align: middle !important;
    }

    .theadd {
        background: #f1f2f7 !important;
        height: 34px !important;
        /* margin-top: 100px!important; */
    }

    @media print {




        .col-md-7 {
            padding: 0px !important;
        }

        .panel {
            margin: 0px;
            padding: 0px;
        }

        .panel-body {
            padding: 0px;
        }

        .wrapper {
            margin: 0px !important;
            padding: 0px !important;
        }

        #invoice_header {
            border-bottom: none;
        }

        .foot {
            right: 0;
            position: fixed;
            text-align: center;
            bottom: 0;
            margin-bottom: 10px !important;
        }

        /*        .panel {
            background: #fff !important;
            margin-top: -30px;
            height: 100%;
            border: 1px solid #000000;
            -webkit-print-color-adjust: exact;
            border-radius: 1px !important;
        }*/

        /*        .invoice_footer {
            right: 0;
            position: fixed;
            text-align: center;
            bottom: 0;
            margin-bottom: 10px !important;
        }*/

        img {
            vertical-align: middle !important;
        }

        table {
            border: 1px solid #000000;
            width: 100%;
        }

        .information_table {
            border: none !important;

            width: 100% !important;
        }

        #invoice_word {
            padding-left: 19px !important;
        }

        .img_class_logo {
            margin-top: -10px;
            width: 120px;
            padding-left: 2px !important;
        }

        .title {
            font-weight: 900 !important;

        }

        h4 {
            margin-top: -10px !important;
            margin-left: 10px !important;
        }

        #first_td {
            width: 17% !important;
            padding-left: 40px !important;
        }

        .second_td {
            width: 34% !important;
        }

        .last_td {
            width: 49% !important;
        }

        .last_td_info {
            margin-bottom: 14px;
        }

        .image_bar {
            margin-top: 15px;
            width: 195px;
            height: 55px !important;
        }

        .col-md-6 {
            width: 49% !important;
            float: left !important;
        }

        .col-md-12 {
            width: 100% !important;
            float: left !important;

        }

        .information {
            min-height: 400px !important;
            border: 1px solid #000000;


        }

        .scroll {
            border: none !important;
        }


        .first_th {
            padding-left: 10px !important;
            text-align: center;
        }

        .second_th {
            padding-right: 10px !important;
            text-align: center;
        }

        .third_th {
            padding-right: 10px !important;
            text-align: center;
        }

        .amount_th {
            padding-left: 10px !important;
            text-align: center;
        }

        .service_th {
            padding-right: 10px !important;
            text-align: center;
        }

        .description_th {
            padding-right: 10px !important;
            text-align: center;
        }


        .amount_in_word {
            padding-left: 7px;
            width: 28% !important;
        }

        .amount_instrong {
            font: 600 !important;
        }

        .amount_bottom {
            margin-bottom: 10px;
        }

        .font_amount {
            font-size: 10px;
        }

        .calculation_second {
            width: 22% !important;
        }

        .calculation_third {
            width: 43% !important;
        }

        .signature {
            margin-top: 10% !important;
            justify-content: space-between;
            flex-direction: column;
        }

        .table-striped th {
            border: 1px solid #eee !important;
            border-left: none !important;
            border-right: none !important;
        }

        .table-striped .lang_payment {
            height: 20px !important;
        }

        .table-striped {
            border: 1px solid #000000 !important;
        }

        .description_info {
            background-color: #929292 !important;

        }

        .scroll th {
            height: 34px !important;
            padding-left: 0px !important;
        }

        .info_text1 {
            width: 10px !important;
        }

        .label_other {
            width: 200px !important;
            font-size: 12px;
        }

        .value_font {
            font-weight: 600;
        }

        .barcode_first_td {
            padding-left: 10px !important;
        }

        .info_rer {
            border: 1px solid #000000 !important;
        }

        .panel {


            padding: 20px;
        }

        .image_text {
            margin-top: -20px !important;
        }
    }
</style>



<!-- <table class="table_bar" style="height:40px; border: none!important">

    <tr>
        <td>&nbsp;</td>
    </tr>


</table> -->



<div class="information" style=" padding-top:7%; border-top:none;">

    <table class="table_bar table_item scroll" style="display:block;">
        <thead class="theadd">
            <tr class="description_info">
                <?php if ($payment->payment_from == 'appointment') { ?>
                    <th class="first_th">#</th>
                    <th class="description_th"><?php echo lang('description'); ?></th>
                    <th class="third_th"><?php echo lang('date_time'); ?></th>
                    <th class="second_th"><?php echo lang('doctor'); ?></th>
                    <th class="amount_th"><?php echo lang('amount'); ?></th>
                <?php } elseif ($payment->payment_from == 'admitted_patient_bed_service') { ?>
                    <th class="first_th">#</th>
                    <th class="description_th"><?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                    <th class="third_th"><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                    <th class="second_th"><?php echo lang('quantity'); ?></th>
                    <th class="amount_th"><?php echo lang('amount'); ?></th>
                <?php } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') { ?>
                    <th class="first_th">#</th>
                    <th class="description_th"><?php echo lang('medicine'); ?> <?php echo lang('name'); ?></th>
                    <th class="third_th"><?php echo lang('unit'); ?> <?php echo lang('price') ?></th>
                    <th class="second_th"><?php echo lang('quantity'); ?></th>
                    <th class="amount_th"><?php echo lang('amount'); ?></th>
                <?php } elseif ($payment->payment_from == 'payment') { ?>
                    <th class="first_th">#</th>

                    <th class="description_th"><?php echo lang('description'); ?></th>
                    <th class="service_th"><?php echo lang('room_no'); ?></th>
                    <th class="third_th"><?php echo lang('unit_price'); ?></th>
                    <th class="second_th"><?php echo lang('qty'); ?></th>
                    <th class="amount_th"><?php echo lang('amount'); ?></th>
                <?php } else { ?>
                    <th class="first_th">#</th>
                    <th class="description_th"><?php echo lang('description'); ?></th>
                    <th class="service_th"><?php echo lang('room_no'); ?></th>

                    <th class="third_th"><?php echo lang('unit_price'); ?></th>
                    <th class="second_th"><?php echo lang('qty'); ?></th>
                    <th class="amount_th"><?php echo lang('amount'); ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody id="info_all">
            <?php
            if ($payment->payment_from == 'appointment') {
                if (!empty($payment->category_name)) {
                    $appointment_details = $this->db->get_where('appointment', array('id' => $payment->appointment_id))->row();
            ?>
                    <tr>
                        <td class="first_th"><?php echo '1'; ?> </td>
                        <td class="description_th"><?php echo $payment->category_name; ?> </td>
                        <td class="third_th"><?php echo date('d-m-Y', $appointment_details->date); ?> <br><?php echo $appointment_details->time_slot; ?> </td>
                        <td class="second_th"> <?php echo $appointment_details->doctorname; ?> </td>
                        <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?> </td>
                    </tr>
                    <?php
                }
            } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                if (!empty($payment->category_name)) {

                    $category = explode('#', $payment->category_name);

                    $i = 0;
                    foreach ($category as $cat) {
                        $i = $i + 1;
                        $cat_new = array();
                        $cat_new = explode('*', $cat);
                    ?>
                        <tr>
                            <td class="first_th"><?php echo $i; ?> </td>
                            <td class="description_th"><?php echo $cat_new[1]; ?> </td>
                            <td class="third_th"><?php echo $settings->currency; ?> <?php echo $cat_new[2]; ?> </td>
                            <td class="second_th"> <?php echo $cat_new[3]; ?> </td>
                            <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $cat_new[4]; ?> </td>
                        </tr>
                    <?php
                    }
                }
            } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                if (!empty($payment->category_name)) {

                    $category = explode('#', $payment->category_name);

                    $i = 0;
                    foreach ($category as $cat) {
                        $i = $i + 1;
                        $cat_new = array();
                        $cat_new = explode('*', $cat);
                        $service = $this->db->get_where('pservice', array('id' => $cat_new[0]))->row();
                    ?>
                        <tr>
                            <td class="first_th"><?php echo $i; ?> </td>
                            <td class="description_th"> <?php echo $service->name; ?> </td>
                            <td class="third_th"><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                            <td class="second_th"> <?php echo '1'; ?> </td>
                            <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $cat_new[1]; ?> </td>
                        </tr>
                        <?php
                    }
                }
            } else {
                if (!empty($payment->category_name)) {
                    $category_name = $payment->category_name;
                    $category_name1 = explode(',', $category_name);
                    $i = 0;


                    foreach ($category_name1 as $category_name2) {
                        $i = $i + 1;
                        $category_name3 = explode('*', $category_name2);

                        if ($category_name3[3] > 0) {
                        ?>

                            <tr>
                                <td class="first_th"><?php echo $i; ?> </td>

                                <td class="description_th"><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->category; ?> </td>
                                <td class="service_th"><?php echo $this->finance_model->getPaymentcategoryById($category_name3[0])->description; ?> </td>
                                <td class="third_th"><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                <td class="second_th"> <?php echo $category_name3[3]; ?> </td>
                                <td class="amount_th"><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[3]; ?> </td>
                            </tr>
            <?php
                        }
                    }
                }
            }
            ?>

        </tbody>

    </table>

</div>
<table class="table_bar" style="height:30px; border-top: none!important">
    <style>
        .note {
            margin-left: 50px !important;
            font-size: 13px;
            /* text-align: center; */
        }
    </style>
    <tr class="note">
        <td>&nbsp;</td>
        <td><?php echo lang('note'); ?> : <strong><?php echo $payment->remarks ?></strong></td>
    </tr>
</table>
<table class="table_bar">
    <tr>
        <td class="amount_in_word">
            <h5 class="font_amount amount_bottom"><strong class="amount_instrong"><?php echo lang('received_with_thanks'); ?> : (<?php echo $settings->currency; ?>)</strong><br>

            </h5>
            <h5 class="font_amount" style="margin-bottom: 55px;">
                <?php echo AmountInWords($this->finance_model->getDepositAmountByPaymentId($payment->id)); ?>
            </h5>
            <div class="signature">

                <strong>________________________<br>
                    <?php echo lang('cashier_signature'); ?></strong>
            </div>

        </td>
        <td class="calculation_second">
            <div class=" pull-left">
                <?php if ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id) == 0) { ?>
                    <h4 style="font-weight: bold;border: 3px solid;
    border-radius: 5px;
    text-align: center; padding: 5px;"><?php echo lang("paid"); ?></h4>
                <?php } else { ?>
                    <h4 style="font-weight: bold; border: 3px solid;
    border-radius: 5px;
    text-align: center; padding: 5px;"><?php echo lang('due_have'); ?></h4>
                <?php } ?>
                <!-- <u><?php echo lang('report_delivery_time'); ?></u><br> -->
                <?php

                //    if (!empty($payment)) {
                //        $date = new DateTime($payment->date_delivery.' '. $payment->time_delivery);

                //        //Print out the 12 hour time using the format method.
                //        $time = $date->format('h:ia') ;
                //        echo $payment->date_delivery.'-'.$time;
                //    }
                ?>
            </div>
            <br>

        </td>
        <td class="calculation_third">
            <div class="paragraphprint1 col-md-12">
                <label class="label_other"><?php echo lang('gross_amount'); ?> </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php echo $settings->currency . ' ' . number_format($payment->amount, 2, ".", ""); ?>

                </span>
            </div>
            <div class="paragraphprint1 col-md-12">
                <label class="label_other">(+)<?php echo lang('vat'); ?>(<?php echo   number_format($payment->vat_amount_percent, 2, ".", ""); ?>%) </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php
                                                                            if (!empty($payment->vat)) {
                                                                                echo number_format($payment->vat, 2, ".", "");
                                                                            } else {
                                                                                echo  $settings->currency . ' ' . '0.00';
                                                                            }
                                                                            ?>

                </span>
            </div>
            <div class="paragraphprint1 col-md-12">
                <label class="label_other">(-)<?php echo lang('discount'); ?>(<?php echo  number_format($payment->percent_discount, 2, ".", ""); ?>%) </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php
                                            $discount = explode('*', $payment->discount);
                                            if (!empty($payment->discount)) {
                                                echo  $settings->currency . ' ' . number_format($payment->discount, 2, ".", "");
                                            } else {
                                                echo $settings->currency . ' ' . '0.00';
                                            }
                                            ?>

                </span>
            </div>
            <div class="paragraphprint1 col-md-12">
                <label class="label_other"><?php echo lang('net_payable'); ?> </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php echo $settings->currency; ?> <?php echo $g = number_format($payment->gross_total, 2, ".", ""); ?>

                </span>
            </div>
            <div class="paragraphprint1 col-md-12">
                <label class="label_other"><?php echo lang('amount_received'); ?> </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php echo $settings->currency; ?> <?php echo $r = number_format($this->finance_model->getDepositAmountByPaymentId($payment->id), 2, ".", ""); ?>

                </span>
            </div>
            <div class="paragraphprint1 col-md-12">
                <label class="label_other"><?php echo lang('balance_due'); ?> </label>
                <label class="info_text1"> : </label>

                <span class="value_font"> <?php echo $settings->currency; ?> <?php echo number_format($g - $r, 2, ".", ""); ?>

                </span>
            </div>
        </td>
    </tr>

</table>
<?php $deposited_amount_payment = $this->finance_model->getDepositByInvoiceId($payment->id);
if (count($deposited_amount_payment) > 1) {
?>
    <table class="table table table-striped">
        <tr>
            <td colspan="3" class="lang_payment" style="text-align: center;
                                            font-weight: 600;"><?php echo lang('payment_history'); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('date'); ?></th>

            <th><?php echo lang('amount'); ?></th>
            <th><?php echo lang('payment_method'); ?></th>
        </tr>
        <?php foreach ($deposited_amount_payment as $deposited) { ?>
            <tr>
                <td>
                    <?php echo date('d-m-y', $deposited->date); ?>
                </td>

                <td>
                    <?php echo $settings->currency . ' ' . $deposited->deposited_amount; ?>
                </td>
                <td>
                    <?php if ($deposited->deposit_type == 'Cash') {
                        echo 'Cash';
                    } else {
                        echo $deposited->gateway;
                    } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php } ?>




<?php
function AmountInWords(float $amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(
        0 => 'Zero', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
    $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($x < $count_length) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
                ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
                ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
        } else $string[] = null;
    }
    $implode_to_Rupees = implode('', array_reverse($string));
    $get_paise = ($amount_after_decimal > 0) ? "Point " . ($change_words[$amount_after_decimal / 10] . " 
            " . $change_words[$amount_after_decimal % 10]) . ' ' : '';
    return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
}
?>