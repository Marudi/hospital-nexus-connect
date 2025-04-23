<?php

class Payroll extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('payroll_model');
    }

    public function index() {
        $year = $this->db->get('attendance')->result();
        if (!empty($year)) {
            $start = $year[0]->year;
        } else {
            $start = date('Y');
        }

        $data['years'] = [];
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        while ($start <= date('Y')) {
            array_push($data['years'], $start);
            $start += 1;
        }
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array1 = $this->db->get('accountant')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array2 = $this->db->get('laboratorist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array3 = $this->db->get('receptionist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array5 = $this->db->get('nurse')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array6 = $this->db->get('doctor')->result_array();

        $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

        $count = 0;
        foreach ($allEmployees as $employee) {
            $result = $this->db->get_where('payroll', array('staff' => $employee['ion_user_id'], 'month' => date('F'), 'year' => date('Y')))->row();
            if ($result) {

                $expense = $result->expense != null ? $result->expense : 0;
                $earning = 0;
                $deduction = 0;
                $earnings = explode('#', $result->earning);
                foreach ($earnings as $e) {
                    $e = explode('_', $e);
                    $earning += $e[1];
                }

                $deductions = explode('#', $result->deduction);
                if (!empty($deduction)) {
                    foreach ($deductions as $d) {
                        $d = explode('_', $d);
                        $deduction += $d[1];
                    }
                } else {
                    $deduction = 0;
                }
                $salary2 = $expense + $earning - $deduction;

                $data['employees'][$count][0] = $this->db->get_where('users', array('id' => $result->staff))->row()->username;
                $data['employees'][$count][1] = $salary2;
                $data['employees'][$count][2] = $result->paid_on;
                $data['employees'][$count][3] = $result->status == 'Generated' ? '<span class="badge bg-warning">' . lang('generated') . '</span>' : '<span class="badge bg-success">' . lang('paid') . '</span>';
                $data['employees'][$count][4] = '<a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-soft-primary waves-effect waves-light" data-id="">' . lang('invoice') . '</a> <a href="payroll/editPayroll?id=' . $result->id . '" class="btn btn-soft-info waves-effect waves-light editPayroll" data-id="">' . lang('edit') . '</a>';

                $count++;
            }
        }

        $this->load->view('home/dashboard');
        $this->load->view('payroll', $data);
        $this->load->view('home/footer');
    }

    public function employeePayroll() {
        $staff = $this->ion_auth->user()->row()->id;
        $year = $this->db->get('attendance')->result();
        if (!empty($year)) {
            $start = $year[0]->year;
        } else {
            $start = date('Y');
        }

        $data['years'] = [];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        while ($start <= date('Y')) {
            array_push($data['years'], $start);
            $start += 1;
        }

        $count = 0;
        for ($i = 0; $i < date('m'); $i++) {
            $result = $this->db->get_where('payroll', array('staff' => $staff, 'month' => $months[$i], 'year' => date('Y')))->row();
            if ($result) {

                $expense = $result->expense != null ? $result->expense : 0;
                $earning = 0;
                $deduction = 0;
                $earnings = explode('#', $result->earning);
                foreach ($earnings as $e) {
                    $e = explode('_', $e);
                    $earning += $e[1];
                }

                $deductions = explode('#', $result->deduction);
                foreach ($deductions as $d) {
                    $d = explode('_', $d);
                    $deduction += $d[1];
                }

                $salary2 = $expense + $earning - $deduction;

                $data['employees'][$count][0] = $months[$i];
                $data['employees'][$count][1] = $salary2;
                $data['employees'][$count][2] = $result->paid_on;
                $data['employees'][$count][3] = $result->status == 'Generated' ? '<span class="badge badge-warning">' . lang('generated') . '</span>' : '<span class="badge bg-success">' . lang('paid') . '</span>';
                $data['employees'][$count][4] = '<a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-primary" data-id="">' . lang('invoice') . '</a>';

                $count++;
            }
        }

        $this->load->view('home/dashboard');
        $this->load->view('employeePayroll', $data);
        $this->load->view('home/footer');
    }

    public function employeePayrollInvoice() {
        $id = $this->input->get('id');
        $staff = $this->ion_auth->user()->row()->id;
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $data['result'] = $this->db->get_where('payroll', array('staff' => $staff, 'month' => $month, 'year' => $year))->row();
        $data['staff'] = '';
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('accountant', array('ion_user_id' => $staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('pharmacist', array('ion_user_id' => $staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('laboratorist', array('ion_user_id' => $staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('nurse', array('ion_user_id' => $staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('receptionist', array('ion_user_id' => $staff))->row();
        }


        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard');
        $this->load->view('payrollInvoice', $data);
        $this->load->view('home/footer');
    }

    function download() {
        $id = $this->input->get('id');

        $data['result'] = $this->db->get_where('payroll', array('id' => $id))->row();
        $data['staff'] = array();
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('accountant', array('ion_user_id' => $data['result']->staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('pharmacist', array('ion_user_id' => $data['result']->staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('laboratorist', array('ion_user_id' => $data['result']->staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('nurse', array('ion_user_id' => $data['result']->staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('receptionist', array('ion_user_id' => $data['result']->staff))->row();
        }
        if (empty($data['staff'])) {
            $data['staff'] = $this->db->get_where('doctor', array('ion_user_id' => $data['result']->staff))->row();
        }


        $data['settings'] = $this->settings_model->getSettings();
        error_reporting(0);
        $data['redirect'] = 'download';
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        $mpdf->SetHTMLFooter('
<div style="font-weight: bold; font-size: 8pt; font-style: italic;">
     ' . lang('user') . ' : ' . $this->ion_auth->user()->row()->username . '
</div>', 'O');
        $html = $this->load->view('payrollInvoice', $data, true);
        $mpdf->WriteHTML($html);

        $filename = "invoice--00" . $id . ".pdf";
        $mpdf->Output($filename, 'D');
    }

    public function salary() {
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array1 = $this->db->get('accountant')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array2 = $this->db->get('laboratorist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array3 = $this->db->get('receptionist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array5 = $this->db->get('nurse')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array6 = $this->db->get('doctor')->result_array();

        $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);
        $data['total'] = count($allEmployees);
        $count = 0;
        foreach ($allEmployees as $employee) {
            $result = $this->db->get_where('salary', array('staff' => $employee['ion_user_id']))->row();
            if ($result) {
                $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                $data['employee'][$count]['staff'] = $user->username;
                $data['employee'][$count]['salary'] = $result->salary;
                $data['employee'][$count]['options'] = '<button class="btn btn-soft-success waves-effect waves-light editSalary" data-id="' . $user->id . '">' . lang('edit') . '</button>';
            } else {
                $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                $data['employee'][$count]['staff'] = $user->username;
                $data['employee'][$count]['salary'] = 0;
                $data['employee'][$count]['options'] = '<button class="btn btn-soft-success waves-effect waves-light editSalary" data-id="' . $user->id . '">' . lang('edit') . '</button>';
            }

            $count++;
        }
        $this->load->view('home/dashboard');
        $this->load->view('salary', $data);
        $this->load->view('home/footer');
    }

    public function getSalaryByStaffId() {
        $id = $this->input->get('id');

        $result = $this->payroll_model->getSalaryByStaffId($id);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode('not_found');
        }
    }

    public function addEditSalary() {
        $salary = $this->input->post('salary');
        $staff = $this->input->post('staff');

        $result = $this->db->get_where('salary', array('staff' => $staff))->row();

        if (empty($result)) {
            $data = array(
                'salary' => $salary,
                'staff' => $staff,
                'hospital_id' => $this->session->userdata('hospital_id')
            );

            $this->payroll_model->insertSalary($data);
        } else {
            $data = array(
                'salary' => $salary
            );

            $this->payroll_model->updateSalary($result->id, $data);
        }

        redirect('payroll/salary');
    }

    public function generatePayroll() {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $deductions = array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array1 = $this->db->get('accountant')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array2 = $this->db->get('laboratorist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array3 = $this->db->get('receptionist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array5 = $this->db->get('nurse')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array6 = $this->db->get('doctor')->result_array();

        $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

        foreach ($allEmployees as $employee) {
            $result = $this->db->get_where('payroll', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

            if (empty($result)) {
                $salary = $this->db->get_where('salary', array('staff' => $employee['ion_user_id']))->row();
                if ($salary) {
                    $salary = $salary->salary;
                } else {
                    $salary = 0;
                }
                $data = array(
                    'staff' => $employee['ion_user_id'],
                    'month' => $month,
                    'year' => $year,
                    'status' => 'Generated',
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'earning' => 'Gross Salary_' . $salary
                );

                $this->payroll_model->createPayroll($data);
            } else if ($result->status != 'Paid') {
                $salary = $this->db->get_where('salary', array('staff' => $employee['ion_user_id']))->row();
                if ($salary) {
                    $salary = $salary->salary;
                } else {
                    $salary = 0;
                }
                $data = array(
                    'staff' => $employee['ion_user_id'],
                    'month' => $month,
                    'year' => $year,
                    'status' => 'Generated',
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'earning' => 'Gross Salary_' . $salary
                );

                $this->payroll_model->updatePayroll($result->id, $data);
            }
        }

        $count = 0;

        $table = ' <table class="table mb-0 w-100" id="salary-sample">
                        <thead>
                            <tr>
                                <th>' . lang('staff') . '</th>
                                <th>' . lang('salary') . '</th>
                                <th>' . lang('paid_on') . '</th>
                                <th>' . lang('status') . '</th>
                                <th class="no-print">' . lang('options') . '</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($allEmployees as $employee) {
            $result = $this->db->get_where('payroll', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();
            $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();

            $expense = $result->expense != null ? $result->expense : 0;
            $earning = 0;
            $deduction = 0;
            $earnings = explode('#', $result->earning);
            foreach ($earnings as $e) {
                $e = explode('_', $e);
                $earning += $e[1];
            }

            $deductions = explode('#', $result->deduction);
            if (!empty($result->deduction)) {
                foreach ($deductions as $d) {
                    $d = explode('_', $d);
                    $deduction += $d[1];
                }
            } else {
                $deduction = 0;
            }

            $salary2 = $expense + $earning - $deduction;

            $status = '';
            if ($result->status == 'Generated') {
                $status .= '<span class="badge bg-secondary">' . lang('generated') . '</span>';
            } else if ($result->status == 'Paid') {
                $status .= '<span class="badge bg-success">' . lang('paid') . '</span>';
            }

            $table .= '<tr><td>' . $user->username . '</td>';
            $table .= '<td>' . $salary2 . '</td>';
            $table .= '<td>' . $result->paid_on . '</td>';
            $table .= '<td>' . $status . '</td>';
            $table .= '<td><a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-soft-primary waves-effect waves-light" data-id="">' . lang('invoice') . '</a> <a href="payroll/editPayroll?id=' . $result->id . '" class="btn btn-primary editPayroll" data-id="">' . lang('edit') . '</a></td>';
            $table .= '</tr>';
        }

        $table .= '</tbody>
                    </table>';

        echo json_encode($table);
    }

    public function payrollTableByMonthYear() {
        $month = $this->input->get('month');
        $year = $this->input->get('year');

        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array1 = $this->db->get('accountant')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array2 = $this->db->get('laboratorist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array3 = $this->db->get('receptionist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array4 = $this->db->get('pharmacist')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array5 = $this->db->get('nurse')->result_array();
        $this->db->select('*');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $array6 = $this->db->get('doctor')->result_array();

        $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

        $table = '<table class="table mb-0 w-100" id="salary-sample">
                        <thead>
                            <tr>
                                <th>' . lang('staff') . '</th>
                                <th>' . lang('salary') . '</th>
                                <th>' . lang('paid_on') . '</th>
                                <th>' . lang('status') . '</th>
                                <th class="no-print">' . lang('options') . '</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($allEmployees as $employee) {
            $result = $this->db->get_where('payroll', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

            if (!empty($result)) {
                $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();

                $expense = $result->expense != null ? $result->expense : 0;
                $earning = 0;
                $deduction = 0;
                $earnings = explode('#', $result->earning);
                foreach ($earnings as $e) {
                    $e = explode('_', $e);
                    $earning += $e[1];
                }

                $deductions = explode('#', $result->deduction);
                if (!empty($result->deduction)) {
                    foreach ($deductions as $d) {
                        $d = explode('_', $d);
                        $deduction += $d[1];
                    }
                } else {
                    $deduction = 0;
                }

                $salary2 = $expense + $earning - $deduction;

                $status = '';
                if ($result->status == 'Generated') {
                    $status .= '<span class="badge bg-secondary">' . lang('generated') . '</span>';
                } else if ($result->status == 'Paid') {
                    $status .= '<span class="badge bg-success">' . lang('paid') . '</span>';
                }

                $table .= '<tr><td>' . $user->username . '</td>';
                $table .= '<td>' . $salary2 . '</td>';
                $table .= '<td>' . $result->paid_on . '</td>';
                $table .= '<td>' . $status . '</td>';
                $table .= '<td><a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-soft-primary waves-effect waves-light" data-id="">' . lang('invoice') . '</a> <a href="payroll/editPayroll?id=' . $result->id . '" class="btn btn-soft-info waves-effect waves-light editPayroll" data-id="">' . lang('edit') . '</a></td>';
                $table .= '</tr>';
            }
        }

        $table .= '</tbody>
                    </table>';

        echo json_encode($table);
    }

    public function editPayroll() {
        $id = $this->input->get('id');

        $result = $this->db->get_where('payroll', array('id' => $id))->row();

        $count = 0;
        $count1 = 0;
        $data = array();
        if ($result->deduction != null) {
            $deductions = explode("#", $result->deduction);

            foreach ($deductions as $d) {
                $deduction = explode('_', $d);
                $data['deduction'][$count]['name'] = $deduction[0];
                $data['deduction'][$count]['value'] = $deduction[1];
                $count++;
            }
        }

        $earnings = explode("#", $result->earning);
        foreach ($earnings as $d) {
            $earning = explode('_', $d);
            $data['earning'][$count1]['name'] = $earning[0];
            $data['earning'][$count1]['value'] = $earning[1];
            $count1++;
        }
        if (empty($data['deduction'])) {
            $data['deduction'] = array();
        }
        $data['id'] = $id;
        $data['result'] = $this->db->get_where('payroll', array('id' => $id))->row();
        $data['user'] = $this->db->get_where('users', array('id' => $data['result']->staff))->row();

        $this->load->view('home/dashboard');
        $this->load->view('editPayroll', $data);
        $this->load->view('home/footer');
    }

    public function updatePayroll() {
        $id = $this->input->post('id');
        $paid_on = $this->input->post('paid_on');
        $status = $this->input->post('status');
        $expense = $this->input->post('expense');

        $earningNames = $this->input->post('earningName');
        $earningValues = $this->input->post('earningValue');

        $deducationNames = $this->input->post('deductionName');
        $deductionValues = $this->input->post('deductionValue');

        $oldData = $this->db->get_where('payroll', array('id' => $id))->row();

        if ($oldData->status == 'Paid') {
            $this->session->set_flashdata('feedback', lang('failed'));
            redirect('payroll/editPayroll?id=' . $id);
        } else {
            $earning = '';
            for ($i = 0; $i < count($earningNames); $i++) {
                if ($i == 0) {
                    if ($earningValues[$i] >= 0 || !empty($earningValues[$i])) {
                        if (!empty($earningNames[$i])) {
                            $earning .= $earningNames[$i] . '_' . $earningValues[$i];
                        } else if (empty($earningNames[$i])) {
                            $earning .= 'earning_' . $earningValues[$i];
                        }
                    }
                } else {
                    if ($earningValues[$i] >= 0 || !empty($earningValues[$i])) {
                        if (!empty($earningNames[$i])) {
                            $earning .= '#' . $earningNames[$i] . '_' . $earningValues[$i];
                        } else if (empty($earningNames[$i])) {
                            $earning .= '#earning_' . $earningValues[$i];
                        }
                    }
                }
            }

            $deduction = '';
            for ($i = 0; $i < count($deducationNames); $i++) {
                if ($i == 0) {
                    if ($deductionValues[$i] >= 0 || !empty($deductionValues[$i])) {
                        if (!empty($deducationNames[$i])) {
                            $deduction .= $deducationNames[$i] . '_' . $deductionValues[$i];
                        } else if (empty($deducationNames[$i])) {
                            $deduction .= 'earning_' . $deductionValues[$i];
                        }
                    }
                } else {
                    if ($deductionValues[$i] >= 0 || !empty($deductionValues[$i])) {
                        if (!empty($deducationNames[$i])) {
                            $deduction .= '#' . $deducationNames[$i] . '_' . $deductionValues[$i];
                        } else if (empty($deducationNames[$i])) {
                            $deduction .= '#deduction_' . $deductionValues[$i];
                        }
                    }
                }
            }

            if (empty($paid_on)) {
                if ($status == 'Paid') {
                    $paid_on = date('d-m-Y');
                } else {
                    $paid_on = null;
                }
            }

            $data = array(
                'earning' => $earning,
                'deduction' => $deduction,
                'expense' => $expense,
                'paid_on' => $paid_on,
                'status' => $status
            );

            if ($status == 'Paid') {

                $totalEarning = 0;
                for ($i = 0; $i < count($earningValues); $i++) {
                    $totalEarning += $earningValues[$i];
                }

                $totaDeduction = 0;
                for ($i = 0; $i < count($deductionValues); $i++) {
                    $totaDeduction += $deductionValues[$i];
                }

                $total = $expense + $totalEarning - $totaDeduction;

                $data2 = array(
                    'category' => 'Salary',
                    'date' => strtotime($paid_on),
                    'amount' => $total,
                    'user' => 1,
                    'datestring' => $paid_on,
                    'hospital_id' => $this->session->userdata('hospital_id')
                );

                $this->db->insert('expense', $data2);
            }

            $this->payroll_model->updatePayroll($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('payroll/editPayroll?id=' . $id);
        }
    }

    public function payrollTableByYear() {
        $staff = $this->ion_user->user()->row()->id;
        $year = $this->input->get('year');
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $table = ' <table class="table mb-0 w-100" id="salary-sample">
                        <thead>
                            <tr>
                                <th>' . lang('month') . '</th>
                                <th>' . lang('salary') . '</th>
                                <th>' . lang('paid_on') . '</th>
                                <th>' . lang('status') . '</th>
                                <th class="no-print">' . lang('options') . '</th>
                            </tr>
                        </thead>
                        <tbody>';

        if ($year == date('Y')) {
            for ($i = 0; $i < date('m'); $i++) {
                $result = $this->db->get_where('payroll', array('staff' => $staff, 'month' => $month[$i], 'year' => $year))->row();

                if (!empty($result)) {
                    $user = $this->db->get_where('users', array('id' => $staff))->row();

                    $expense = $result->expense != null ? $result->expense : 0;
                    $earning = 0;
                    $deduction = 0;
                    $earnings = explode('#', $result->earning);
                    foreach ($earnings as $e) {
                        $e = explode('_', $e);
                        $earning += $e[1];
                    }

                    $deductions = explode('#', $result->deduction);
                    foreach ($deductions as $d) {
                        $d = explode('_', $d);
                        $deduction += $d[1];
                    }

                    $salary2 = $expense + $earning - $deduction;

                    $status = '';
                    if ($result->status == 'Generated') {
                        $status .= '<span class="badge bg-secondary">' . lang('generated') . '</span>';
                    } else if ($result->status == 'Paid') {
                        $status .= '<span class="badge bg-success">' . lang('paid') . '</span>';
                    }

                    $table .= '<tr><td>' . $month[$i] . '</td>';
                    $table .= '<td>' . $salary2 . '</td>';
                    $table .= '<td>' . $result->paid_on . '</td>';
                    $table .= '<td>' . $status . '</td>';
                    $table .= '<td><a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-soft-primary waves-effect waves-light" data-id="">' . lang('invoice') . '</a> <a href="payroll/editPayroll?id=' . $result->id . '" class="btn btn-soft-info waves-effect waves-light editPayroll" data-id="">' . lang('edit') . '</a></td>';
                    $table .= '</tr>';
                }
            }
        } else {
            for ($i = 0; $i < 12; $i++) {
                $result = $this->db->get_where('payroll', array('staff' => $staff, 'month' => $month[$i], 'year' => $year))->row();

                if (!empty($result)) {
                    $user = $this->db->get_where('users', array('id' => $staff))->row();

                    $expense = $result->expense != null ? $result->expense : 0;
                    $earning = 0;
                    $deduction = 0;
                    $earnings = explode('#', $result->earning);
                    foreach ($earnings as $e) {
                        $e = explode('_', $e);
                        $earning += $e[1];
                    }

                    $deductions = explode('#', $result->deduction);
                    foreach ($deductions as $d) {
                        $d = explode('_', $d);
                        $deduction += $d[1];
                    }

                    $salary2 = $expense + $earning - $deduction;

                    $status = '';
                    if ($result->status == 'Generated') {
                        $status .= '<span class="badge bg-secondary">' . lang('generated') . '</span>';
                    } else if ($result->status == 'Paid') {
                        $status .= '<span class="badge bg-success">' . lang('paid') . '</span>';
                    }

                    $table .= '<tr><td>' . $month[$i] . '</td>';
                    $table .= '<td>' . $salary2 . '</td>';
                    $table .= '<td>' . $result->paid_on . '</td>';
                    $table .= '<td>' . $status . '</td>';
                    $table .= '<td><a href="payroll/download?id=' . $result->id . '&month=' . date('F') . '&year=' . date('Y') . '" class="btn btn-soft-primary waves-effect waves-light" data-id="">' . lang('invoice') . '</a> <a href="payroll/editPayroll?id=' . $result->id . '" class="btn btn-soft-info waves-effect waves-light editPayroll" data-id="">' . lang('edit') . '</a></td>';
                    $table .= '</tr>';
                }
            }
        }

        $table .= '</tbody>
                    </table>';

        echo json_encode($table);
    }

}
