<?php

class Attendance_model extends CI_Model {
    public function updateAttendance($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('attendance', $data);
    }
}

