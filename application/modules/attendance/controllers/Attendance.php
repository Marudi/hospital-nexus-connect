<?php

class Attendance extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('attendance_model');
    }

    public function index() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $this->createNewAttendance();
            $year = $this->db->get('attendance')->result();
            if (!empty($year)) {
                $start = $year[0]->year;
            } else {
                $start = date('Y');
            }

            $current_month = date('F');
            $current_year = date('Y');

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
            $data['total_employees'] = count($allEmployees);
            $count = 0;

            foreach ($allEmployees as $employee) {
                $data['employee'][$count] = $employee['ion_user_id'];
                $index = 0;
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $current_month, 'year' => $current_year))->row();
                $data['details'][$count][$index] = $this->db->get_where('users', array('id' => $result->staff))->row()->username;
                $index++;
                $total = 0;
                $logs = explode('_', $result->log);

                $num_of_days = (int) date("t");

                if (!empty($result->log)) {
                    for ($i = 0; $i <= $num_of_days; $i++) {

                        if (count($logs) >= $i) {
                            if (!empty($logs[$i])) {
                                if ($logs[$i] == 'yes') {
                                    $total++;
                                    $data['details'][$count][$index] = $logs[$i];
                                } else {
                                    $data['details'][$count][$index] = $logs[$i];
                                }
                            } else {
                                $data['details'][$count][$index] = '';
                            }
                            $index++;
                        } else {
                            $data['details'][$count][$index] = '';
                            $index++;
                        }
                    }
                }
                $data['details'][$count][$index] = $total;
                $count++;
            }

            $data['years'] = [];
            $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            while ($start <= date('Y')) {
                array_push($data['years'], $start);
                $start += 1;
            }

            $this->load->view('home/dashboard');
            $this->load->view('attendance', $data);
            $this->load->view('home/footer');
        } else {
            $staff = $this->ion_auth->user()->row()->id;
            $this->createNewAttendance();
            $year = $this->db->get('attendance')->result();
            if (!empty($year)) {
                $start = $year[0]->year;
            } else {
                $start = date('Y');
            }

            $current_month = date('F');
            $current_year = date('Y');

            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array6 = $this->db->get('doctor')->result_array();

            $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);
            $data['total_employees'] = count($allEmployees);
            $count = 0;

            foreach ($allEmployees as $employee) {
                $data['employee'][$count] = $employee['ion_user_id'];
                $index = 0;
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $current_month, 'year' => $current_year))->row();
                $data['details'][$count][$index] = $this->db->get_where('users', array('id' => $result->staff))->row()->username;
                $index++;
                $total = 0;
                $logs = explode('_', $result->log);
                for ($i = 0; $i < date('t'); $i++) {
                    if (count($logs) >= $i) {
                        if (!empty($logs[$i])) {
                            if ($logs[$i] == 'yes') {
                                $total++;
                                $data['details'][$count][$index] = $logs[$i];
                            } else {
                                $data['details'][$count][$index] = $logs[$i];
                            }
                        }else{
                             $data['details'][$count][$index] = '';
                        }
                        $index++;
                    } else {
                        $data['details'][$count][$index] = '';
                        $index++;
                    }
                }
                $data['details'][$count][$index] = $total;
                $count++;
            }

            $data['years'] = [];
            $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            while ($start <= date('Y')) {
                array_push($data['years'], $start);
                $start += 1;
            }

            $this->load->view('home/dashboard');
            $this->load->view('attendance', $data);
            $this->load->view('home/footer');
        }
    }

    public function createNewAttendance() {
        $current_month = date('F');
        $current_year = date('Y');

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
            $log = '';
            $details = '';
            $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $current_month, 'year' => $current_year))->row();

            if (empty($result)) {
                for ($i = 1; $i <= date('d'); $i++) {
                    if ($i != date('d')) {
                        $log .= 'no_';
                        $details .= 'NONE_NONE_NONE_NONE_office#';
                    } else {
                        $log .= 'no';
                        $details .= 'NONE_NONE_NONE_NONE_office';
                    }
                }

                $data = array(
                    'staff' => $employee['ion_user_id'],
                    'month' => $current_month,
                    'year' => $current_year,
                    'log' => $log,
                    'details' => $details
                );

                $this->db->insert('attendance', $data);
            } else {
                $logs = explode('_', $result->log);
                if (count($logs) < date('d')) {
                    $newLog = $result->log;
                    $newDetails = $result->details;
                    while ($logCount <= date('d')) {
                        $newLog .= '_no';
                        $newDetails .= '#NONE_NONE_NONE_NONE_office';
                        $logCount++;
                    }

                    $newData = array(
                        'log' => $newLog,
                        'details' => $newDetails
                    );

                    $this->db->where('id', $result->id);
                    $this->db->update('attendance', $newData);
                }
            }
        }
    }

    public function getAttendanceDetails() {
        $date = $this->input->get('date');
        $id = $this->input->get('id');
        $month = date('F', strtotime($date));
        $year = date('Y', strtotime($date));
        $day = explode('-', $date);

        $result = $this->db->get_where('attendance', array('staff' => $id, 'month' => $month, 'year' => $year))->row();

        $details = explode('#', $result->details);

        $detail = explode('_', $details[$day[0] - 1]);

        $data['clock_in'] = $detail[0] == 'NONE' ? '' : $detail[0];
        $data['clock_out'] = $detail[1] == 'NONE' ? '' : $detail[1];
        $data['late'] = $detail[2] == 'late' ? TRUE : FALSE;
        $data['halfday'] = $detail[3] == 'halfday' ? TRUE : FALSE;
        $data['office'] = $detail[4];
        $data['id'] = $result->id;

        echo json_encode($data);
    }

    public function updateAttendance() {
        $date = $this->input->post('date');
        $clock_in = $this->input->post('clock_in');
        $clock_out = $this->input->post('clock_out');
        $late = $this->input->post('late');
        $halfday = $this->input->post('halfday');
        $work_from = $this->input->post('work_from');

        $id = $this->input->post('id');
        $month = date('F', strtotime($date));
        $year = date('Y', strtotime($date));
        $day = explode('-', $date);

        $result = $this->db->get_where('attendance', array('id' => $id))->row();

        $details = explode('#', $result->details);

        $detail = explode('_', $details[$day[0] - 1]);

        $finalDetail = ($clock_in != '' ? $clock_in : 'NONE') . '_' . ($clock_out != '' ? $clock_out : 'NONE') . '_' . ($late == 'late' ? $late : 'NONE') . '_' . ($halfday == 'halfday' ? $halfday : 'NONE') . '_' . ($work_from == '' ? 'office' : $work_from);

        $details[$day[0] - 1] = $finalDetail;

        $detail = implode('#', $details);

        $logs = explode("_", $result->log);

        if ($clock_in != '') {
            $logs[$day[0] - 1] = 'yes';
        }

        $log = implode('_', $logs);

        $data = array(
            'log' => $log,
            'details' => $detail
        );

        $this->attendance_model->updateAttendance($id, $data);

        redirect('attendance');
    }

    public function createAttendanceTable() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
            $id = $this->input->get('id');

            $totalDay = date('t', strtotime($month . '-' . $year));

            if ($id == 0) {
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

                $data = '<div class="col-md-12 attendanceDiv_col">
                <table class="table mb-0" id="">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
                for ($i = 1; $i <= $totalDay; $i++) {
                    $data .= '<th class="text_center">' . $i . '</th>';
                }

                $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>';

                foreach ($allEmployees as $employee) {
                    $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

                    if (!empty($result)) {
                        $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                        $totalAttendance = 0;
                        $logs = explode('_', $result->log);
                        $data .= '<tr><td>' . $user->username . '</td>';

                        for ($i = 1; $i <= $totalDay; $i++) {
                            if ($i <= count($logs)) {
                                if ($logs[$i] == 'yes') {
                                    $totalAttendance++;
                                    $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check" ></i></button></td>';
                                } else {
                                    $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times" ></i></button></td>';
                                }
                            } else {
                                $data .= '<td></td>';
                            }
                        }


                        $data .= '<td>' . $totalAttendance . '</td></tr>';
                    } else {
                        
                    }
                }

                $data .= '</tbody>
                        </table>
                    </div>';
            } else {
                $result = $this->db->get_where('attendance', array('staff' => $id, 'month' => $month, 'year' => $year))->row();
                if (empty($result)) {
                    $data = '<div class="col-md-12 text-center"> <b>NO DATA FOUND</b> </div>';
                } else {
                    $user = $this->db->get_where('users', array('id' => $id))->row();
                    $totalAttendance = 0;
                    $logs = explode('_', $result->log);

                    $data = '<div class="col-md-12 attendanceDiv_col">
                    <table class="table mb-0" id="">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
                    for ($i = 1; $i <= $totalDay; $i++) {
                        $data .= '<th class="text_center">' . $i . '</th>';
                    }

                    $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>
                            <tr>
                            <td>' . $user->username . '</td>';

                    for ($i = 1; $i <= $totalDay; $i++) {
                        if ($i <= count($logs)) {
                            if ($logs[$i] == 'yes') {
                                $totalAttendance++;
                                $data .= '<td><button class="markAttandance markAttendance_css" data-employee="' . $id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check"></i></button></td>';
                            } else {
                                $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times"></i></button></td>';
                            }
                        } else {
                            $data .= '<td></td>';
                        }
                    }
                    $data .= '<td>' . $totalAttendance . '</td></tr>
                </tbody>
                        </table>
                    </div>';
                }
            }
        } else {
            $staff = $this->ion_auth->user()->row()->id;
            $month = $this->input->get('month');
            $year = $this->input->get('year');

            $totalDay = date('t', strtotime($month . '-' . $year));

            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array1 = $this->db->get('accountant')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array2 = $this->db->get('laboratorist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array3 = $this->db->get('receptionist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array4 = $this->db->get('pharmacist')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array5 = $this->db->get('nurse')->result_array();
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('ion_user_id', $staff);
            $array6 = $this->db->get('doctor')->result_array();

            $allEmployees = array_merge($array1, $array2, $array3, $array4, $array5, $array6);

            $data = '<div class="col-md-12 attendanceDiv_col">
            <table class="table mb-0" id="">
                            <thead class="thead-dark">
                            <th>' . lang('staff') . '</th>';
            for ($i = 1; $i <= $totalDay; $i++) {
                $data .= '<th class="text_center">' . $i . '</th>';
            }

            $data .= '<th>' . lang('total') . '</th>
                            </thead>
                            <tbody>';

            foreach ($allEmployees as $employee) {
                $result = $this->db->get_where('attendance', array('staff' => $employee['ion_user_id'], 'month' => $month, 'year' => $year))->row();

                if (!empty($result)) {
                    $user = $this->db->get_where('users', array('id' => $employee['ion_user_id']))->row();
                    $totalAttendance = 0;
                    $logs = explode('_', $result->log);
                    $data .= '<tr><td>' . $user->username . '</td>';

                    for ($i = 1; $i <= $totalDay; $i++) {
                        if ($i <= count($logs)) {
                            if ($logs[$i - 1] == 'yes') {
                                $totalAttendance++;
                                $data .= '<td><button class="markAttandance markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-check" ></i></button></td>';
                            } else {
                                if ($i >= date('d')) {
                                    $optionMark = "markAttandance";
                                } else {
                                    $optionMark = "";
                                }
                                $data .= '<td><button class="' . $optionMark . '  markAttendance_css"  data-employee="' . $user->id . '" data-id="' . $i . '-' . date('m-Y') . '"><i class="fas fa-times" ></i></button></td>';
                            }
                        } else {
                            $data .= '<td></td>';
                        }
                    }


                    $data .= '<td>' . $totalAttendance . '</td></tr>';
                } else {
                    
                }
            }

            $data .= '</tbody>
                        </table>
                    </div>';
        }

        echo json_encode($data);
    }

}
