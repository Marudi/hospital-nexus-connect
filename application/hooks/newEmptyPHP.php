<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function required() {
    $CI = & get_instance();
    $CI->load->library('Ion_auth');
    $CI->load->library('session');
    $CI->load->library('form_validation');
    $CI->load->library('upload');
    $CI->load->library('parser');
    $CI->load->helper('security');
    // $CI->load->library('ControllerList');
    //$CI->load->config('paypal');

    $RTR = & load_class('Router');
    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "site" && $RTR->class != "api") {
        if (!$CI->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }


    // Get all controllers 
    //     $allControllers = $CI->controllerlist->getControllers();




    $CI->load->model('settings/settings_model');
    $CI->load->model('ion_auth_model');
    $CI->load->model('hospital/hospital_model');



    /*
      if ($RTR->class == 'site') {
      if ($CI->ion_auth->logged_in() && $CI->ion_auth->in_group(array('admin'))) {
      $current_user_id = $CI->ion_auth->user()->row()->id;
      $CI->hospital_id = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->id;
      if (!empty($CI->hospital_id)) {
      $newdata = array(
      'url_id' => $CI->hospital_id,
      );
      }

      $url = $CI->uri->segment(3);
      if (!empty($url)) {
      $newdata = array('url_id' => null,);
      $CI->session->set_userdata($newdata);
      if (!empty($CI->hospital_id)) {
      $newdata = array(
      'url_id' => $CI->hospital_id,
      );
      $CI->session->set_userdata($newdata);
      } else {
      redirect('home/permission');
      }
      }
      } else {
      //$uri= & load_class('URI','core');
      $newdata = array('url_id' => null,);
      $CI->session->set_userdata($newdata);

      $url = $CI->uri->segment(2);


      $CI->hospital_id = $CI->db->get_where('single_website_settings', array('url_hospital' => $url))->row()->hospital_id;
      if (!empty($CI->hospital_id)) {
      $newdata = array(
      'url_id' => $CI->hospital_id,
      );
      $CI->session->set_userdata($newdata);
      } else {
      redirect('home/permission');
      }
      }
      } else

     */



    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "api") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($CI->ion_auth->in_group(array('admin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $CI->hospital_id = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->id;
                if (!empty($CI->hospital_id)) {
                    $newdata = array(
                        'hospital_id' => $CI->hospital_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            } else {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $CI->hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                if (!empty($CI->hospital_id)) {
                    $newdata = array(
                        'hospital_id' => $CI->hospital_id,
                    );
                    $CI->session->set_userdata($newdata);
                }
            }
        } else {
            $CI->hospital_id = 'superadmin';
            if (!empty($CI->hospital_id)) {
                $newdata = array(
                    'hospital_id' => $CI->hospital_id,
                );
                $CI->session->set_userdata($newdata);
            }
        }
    }
    
    
    

    // Language
    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "api") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            $CI->db->where('hospital_id', $CI->hospital_id);
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        } else {
            $CI->db->where('hospital_id', 'superadmin');
            $CI->language = $CI->db->get('settings')->row()->language;
            $CI->lang->load('system_syntax', $CI->language);
        }
    }
    if ($RTR->class == "frontend" || $RTR->class == "request") {
        $CI->db->where('hospital_id', 'superadmin');
        $CI->language = $CI->db->get('settings')->row()->language;
        $CI->lang->load('system_syntax', $CI->language);
    }
    // Language
    // Currency
    if ($RTR->class != "auth") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            $CI->db->where('hospital_id', $CI->hospital_id);
            $CI->currency = $CI->db->get('settings')->row()->currency;
        } else {
            $CI->db->where('hospital_id', 'superadmin');
            $CI->currency = $CI->db->get('settings')->row()->currency;
        }
    }
    // Currency


    if ($RTR->class != "frontend" && $RTR->class != "request" && $RTR->class != "auth" && $RTR->class != "site" && $RTR->class != "api") {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($CI->ion_auth->in_group(array('admin'))) {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $modules = $CI->db->get_where('hospital', array('ion_user_id' => $current_user_id))->row()->module;
                $CI->modules = explode(',', $modules);
            } else {
                $current_user_id = $CI->ion_auth->user()->row()->id;
                $group_id = $CI->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $CI->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $hospital_id = $CI->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
                $modules = $CI->db->get_where('hospital', array('id' => $hospital_id))->row()->module;
                $CI->modules = explode(',', $modules);
            }
        }
    }

//,'gridsection','featured','gallery','review'
    $common = array('auth', 'frontend', 'settings', 'home', 'profile', 'request', 'site', 'api');

    if (!in_array($RTR->class, $common)) {
        if (!$CI->ion_auth->in_group(array('superadmin'))) {
            if ($RTR->class != "schedule" && $RTR->class != "meeting" && $RTR->class != "featured" && $RTR->class != "gallery" && $RTR->class != "review" && $RTR->class != "gridsection" && $RTR->class != "service" && $RTR->class != "slide") {
                if ($RTR->class != "pgateway") {
                    if (!in_array($RTR->class, $CI->modules)) {
                        redirect('home');
                    }
                } elseif (!in_array('finance', $CI->modules)) {
                    redirect('home');
                }
            } elseif (!in_array('appointment', $CI->modules)) {
                redirect('home');
            }
        }
    }
}
