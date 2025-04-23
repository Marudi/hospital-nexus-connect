<?php

class Payroll_model extends CI_Model {
    public function insertSalary($data) {
        $this->db->insert('salary', $data);
    }
    
    public function updateSalary($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('salary', $data);
    }
    
    public function getSalaryByStaffId($id) {
        $this->db->where('staff', $id);
        return $this->db->get('salary')->row();
    }
    
    public function createPayroll($data) {
        $this->db->insert('payroll', $data);
    }
    
    public function updatePayroll($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payroll', $data);
    }
}

