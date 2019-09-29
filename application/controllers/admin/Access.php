<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('my_uri');
        $this->load->helper('my_image');
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->helper(array('url', 'form'));


        if (!$this->ion_auth->logged_in())
            redirect('auth/login');
    }

    public function index() {
        $this->load->view('auth/login');
    }

    public function user() {
        /* $data_u= $this->ion_auth->users()->result();
          foreach ($data_u as $k => $user)
          {
          $data_u[$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
          } */
        $data_u = array("userna" => "dfdf", "email" => "fdfds", "group" => "dsfdf", "activo" => "erwer");
        print_r(json_encode($data_u));
    }

    public function listresident() {
        $data['title'] = 'Administrator';
        $data['script'] = $this->load->view('admin/scripttable', '', TRUE);
        $data['content'] = $this->load->view('admin/a_listresident', '', TRUE);
        $this->load->view('admin/a_plantilla', $data);
    }

    public function logout_register() {
        $user_d = $this->ion_auth->user()->row();
        $this->ion_auth->delete_user($user_d->id);
        redirect('auth/logout');
    }

    function controlusuario() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('bootstrap');
            $crud->set_table('users');
            $crud->set_subject('Users');

            $crud->required_fields('username', 'password', 'email', 'active', 'first_name', 'last_name');
            $crud->columns('ip_address', 'username', 'password', 'salt', 'email', 'activation_code', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on', 'last_login', 'active', 'first_name', 'last_name', 'phone', 'company');

            //$crud->set_relation_n_n('Roles', 'users_groups', 'groups', 'users_id', 'group_id', 'name');
            $crud->field_type('password', 'password');

            $output = $crud->render();
            //  print_r($output);
            $data['cont'] = $this->load->view('admin/table_user', $output, TRUE);
            $this->render('admin/table_user', 'template_admin', $this->header_view, $data, $this->footer_view);

            // $this->load->view('cpanel/plantilla', $output); 
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function controlgrupo() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('bootstrap');
            $crud->set_table('groups');
            $crud->set_subject('Groups');

            $crud->required_fields('name');
            $crud->columns('name', 'description');

            $crud->unset_texteditor('description');

            $crud->display_as('name', 'Group name');

            $output = $crud->render();

            $data['cont'] = $this->load->view('admin/table_user', $output, TRUE);
            $this->render('admin/table_user', 'template_admin', $this->header_view, $data, $this->footer_view);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
