<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mainten extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('autenticado')) {
            redirect(site_url('Init'));
        }
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->library('Form_builder');
        $this->load->library('System_message');
        $this->load->library('Email_client');
        $this->load->library('Session');
        $this->load->model(array('M_user', 'M_access', 'M_levels', 'M_tbldistricts'));
        $this->load->database();
        $this->load->helper('language');
        $this->load->library('upload');
    }

    function users() {

        $data['title'] = 'Mainten';
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['pag'] = 'user';
        $data['role'] = $this->M_levels->get_all_levels();
        $this->data_template['script'] = $this->load->view('admin/s_users', NULL, TRUE);
        $this->render('admin/l_users', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function levelsetup() {

        $data['title'] = 'Levels Setup';
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['pag'] = 'user';
        $data['role'] = $this->M_levels->get_all_levels();
        $this->data_template['script'] = $this->load->view('admin/s_users', NULL, TRUE);
        $this->render('admin/levelsetup', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function userslist() {
        $user = $this->M_user->get_all_users();
        foreach ($user as $key => $value) {
            $temp = $this->M_levels->get_one_levels($value['levels_idlevels']);
            $user[$key]['rolelevel'] = $temp[0]['rolename'];
        }

        print_r(json_encode($user));
    }

    function edit_user() {
        $user['d_username'] = $this->input->post('recuser');
        $user_pass = $this->input->post('password');
        $user_pass_ret = $this->input->post('ret_password');
        $user['d_status'] = $this->input->post('state');
        $user['d_levels'] = $this->input->post('role');
        $user['d_photo'] = 'placeholder.png';
        if ($user_pass === $user_pass_ret && $user_pass !== "") {
            $user['d_password'] = md5($user_pass);
            $this->M_user->update_users($user);
            $noty = 'Your password has been successfully stored into the database.';
        } else {
            $this->M_user->update_users_sin($user);
            $noty = 'The status or role have been changed.';
        }

        print_r(json_encode($noty));
    }

    function delete_user() {
        $id = $this->input->post('recuser');
        if (count($this->M_user->get_all_users()) > 1) {
            $this->M_user->del_users($id);
            print_r(json_encode('The user ' . $id . ' has been successfully deleted from the database.'));
        } else
            print_r(json_encode('The user ' . $id . ' is the only user.'));
    }

    function add_user() {
        $user['d_username'] = $this->input->post('username');
        $pass = $this->input->post('passwd');
        $r_pass = $this->input->post('r_passwd');
        $user['d_photo'] = 'placeholder.png';
        $user['d_levels'] = $this->input->post('role');
        $user['d_status'] = 1;
        if ($pass === $r_pass) {
            $user['d_password'] = md5($this->input->post('passwd'));
            $this->M_user->set_users($user);
            print_r(json_encode($user['d_username'] . ' has been added.'));
        } else {
            print_r(json_encode('retry the password.'));
        }
    }

    function do_uploads() {

        $config['upload_path'] = '../assets/avatars/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);
        $file = $this->input->post('filename');

        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors());
            print_r(json_encode($error));


            //   $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            print_r(json_encode($data));
        }
    }

}
