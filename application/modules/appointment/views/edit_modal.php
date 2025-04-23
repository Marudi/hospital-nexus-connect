<form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel patient_div">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label>
                        <select class="form-control m-bot15  pos_select1 patient" id="pos_select1" name="patient" value='' required>

                        </select>
                    </div>
                    <div class="pos_client1 clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                                        if (!empty($patient->sex)) {
                                                            if ($patient->sex == 'Male') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('male'); ?> </option>
                                <option value="Female" <?php
                                                        if (!empty($patient->sex)) {
                                                            if ($patient->sex == 'Female') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('female'); ?> </option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel doctor_div1">
                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> &#42;</label>
                        <select class="form-control m-bot15 doctor" id="adoctors1" name="doctor" value='' required>

                        </select>
                    </div>
                    <input type="hidden" name="redirectlink" value="10">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &#42;</label>
                        <input type="text" class="form-control default-date-picker" autocomplete="off" id="date1" required="" onkeypress="return false;" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''>

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label>
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php ?>> <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php ?>> <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php ?>> <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php ?>> <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div> 

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-12 panel">

                        <label class=""><?php echo lang('visit'); ?> <?php echo lang('description'); ?> &#42;</label>

                        <select class="form-control m-bot15" name="visit_description" id="visit_description1" value='' required>

                        </select>

                    </div>

                    <input type="hidden" name="id" id="appointment_id" value=''>
                    <div class="form-group col-md-4 hidden consultant_fee_div">
                        <label for="exampleInputEmail1"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></label>
                        <input type="number" class="form-control" name="visit_charges" id="visit_charges1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-4 hidden consultant_fee_div">
                        <label for="exampleInputEmail1"><?php echo lang('discount'); ?></label>
                        <input type="number" class="form-control" name="discount" id="discount1" value='0' placeholder="">
                    </div>
                    <div class="form-group col-md-4 hidden consultant_fee_div">
                        <label for="exampleInputEmail1"><?php echo lang('grand_total'); ?></label>
                        <input type="number" class="form-control" name="grand_total" id="grand_total1" value='0' placeholder="" readonly="">
                    </div>
                    <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                        <div class="col-md-12 hidden pay_now">
                            <input type="checkbox" id="pay_now_appointment1" name="pay_now_appointment" value="pay_now_appointment">
                            <label for=""> <?php echo lang('pay_now'); ?></label><br>
                            <span class="info_message"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed') ?></span>
                        </div>
                        <div class="col-md-12 hidden payment_status form-group">
                            <label for=""> <?php echo lang('payment'); ?> <?php echo lang('status'); ?></label><br>
                            <input type="text" class="form-control" id="pay_now_appointment" name="payment_status_appointment" value="paid" readonly="">


                        </div>
                        <div class="payment_label col-md-12 hidden deposit_type1">
                            <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>

                            <div class="">
                                <select class="form-control m-bot15 js-example-basic-single selecttype1" id="selecttype1" name="deposit_type" value=''>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                        <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                        <option value="Card"> <?php echo lang('card'); ?> </option>
                                    <?php } ?>

                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <?php
                            $payment_gateway = $settings->payment_gateway;
                            ?>



                            <div class="card1">

                                <hr>
                                <?php if ($payment_gateway != 'Paymob') { ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                        <div class="payment pad_bot">
                                            <img src="uploads/card.png" width="100%">
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <?php
                                if ($payment_gateway == 'PayPal') {
                                ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                        <select class="form-control m-bot15" name="card_type" value=''>

                                            <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                            <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                            <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                        </select>
                                    </div>
                                <?php } ?>
                                <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                        <input type="text" id="cardholder1" class="form-control pay_in" name="cardholder" value='' placeholder="">
                                    </div>
                                <?php } ?>
                                <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                        <input type="text" id="card1" class="form-control pay_in" name="card_number" value='' placeholder="">
                                    </div>



                                    <div class="col-md-8 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                        <input type="text" class="form-control pay_in" id="expire1" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" readonly>
                                    </div>
                                    <div class="col-md-4 payment pad_bot">
                                        <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                        <input type="text" class="form-control pay_in" id="cvv1" maxlength="3" name="cvv" value='' placeholder="">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>


                        </div>
                        <div class="col-md-12 panel">
                            <div class="col-md-3 payment_label">
                            </div>
                            <div class="col-md-9">
                                <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                <div class="form-group cashsubmit1 payment  right-six col-md-12">
                                    <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                                <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                <div class="form-group cardsubmit1  right-six col-md-12 hidden">
                                    <button type="submit" name="pay_now" id="submit-btn1" class="btn btn-info row pull-right" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                ?>onClick="stripePay1(event);" <?php }
                                                                                                                                                                ?> <?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                                                                                                                                                                    ?>onClick="twoCheckoutPay1(event);" <?php }
                                                                                                            ?>> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="form-group  payment  right-six col-md-12">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    <?php } ?>
                </form>