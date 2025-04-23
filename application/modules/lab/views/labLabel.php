<html>
    <body>
        <style>
/*            @page {
  size: 5.5in 3.5in;
}*/

td {
    padding-bottom: 5px;
}

input {
    border: 1px solid black;
    -webkit-print-color-adjust: exact;
}
        </style>
        <div style="display: flex; max-width: 4.9in; margin-top: 20px;">
            <div>
                <table>
                    <tr>
                        <td>PID: <?php echo $patient->id; ?></td>
                        <td>Invoice ID: <?php echo $lab->invoice_id; ?></td>
                    </tr>
                    <tr>
                        <td>Patient: <?php echo $patient->name; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php $age = explode('-', $patient->age);
                            if(count($age) == 3) { ?>
                                <td>Age: <?php echo $age[0] . " Y " . $age[1] . " M " . $age[2] . " D"; ?></td>
                            <?php } else {?>
                                <td>Age: </td>
                                <?php 
                            }?>
                        
                        <td></td>
                    </tr>
                    <tr>
                        <td>Gender: <?php echo $patient->sex; ?></td>
                        <td>Date: <?php echo date('d/m/Y', $lab->date) ?></td>
                    </tr>
                    <tr>
                        <td>Ref By:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Test: <?php
                            $i = 0;
                            foreach ($labels as $label) {
                                if ($i == 0) {
                                    echo $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                    //echo $this->finance_model->getPaymentCategoryById($label->category_id);
                                } else {
                                    echo ', ' . $this->db->get_where('payment_category', array('id' => $label->category_id))->row()->category;
                                }
                                $i++;
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td>
                            Film: <input type="text">
                        </td>
                        <td>
                            Paper Print: <input type="text">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $patient->id; ?>&print=true" />
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <img alt="testing" src="<?php echo site_url('lab/barcode') ?>?text=000000000<?php echo $lab->invoice_id; ?>&print=true&orientation=vertical" />
            </div>
        </div>
    </body>
</html>