<?php

function getPendingLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'pending');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getPendingLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'pending');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getPendingLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'pending')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getPendingLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'pending');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getPendingLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'pending')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getWaitingLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'waiting');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getWaitingLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'waiting');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getWaitingLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'waiting')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getWaitingLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'waiting');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getWaitingLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'waiting')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getCompletedLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'complete');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getCompletedLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'complete');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getCompletedLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'complete')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getCompletedLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'complete');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getCompletedLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'complete')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getSampleCollectedLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'sample_taken');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getSampleCollectedLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'sample_taken');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getSampleCollectedLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'sample_taken')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getSampleCollectedLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'sample_taken');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getSampleCollectedLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'sample_taken')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getDeliveredLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivered');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveredLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivered');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveredLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'delivered')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getDeliveredLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivered');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveredLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'delivered')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getDeliveryPendingLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivery_pending');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveryPendingLabWithoutSearch($order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivery_pending');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveryPendingLabBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('lab')
                ->where('status', 'delivery_pending')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getDeliveryPendingLabByLimit($limit, $start, $order, $dir) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'delivery_pending');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getDeliveryPendingLabByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status', 'delivery_pending')
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }
