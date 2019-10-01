<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Admin
 *
 * @author Michel
 */
class Users extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {
        parent::__construct();

        //new authentication method
        $this->auth->route_access();

    }

    public function setup() {
        $data = array();
        try {
            $data['title'] = 'Users';
            $data['pag'] = 'user';

            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('acl_users');
            $crud->set_subject('user');
            $crud->columns('name', 'username', 'status', 'roles');
            $crud->fields('name', 'username', 'password', 'status', 'roles');
            $crud->required_fields('username', 'password', 'status', 'roles');
            $crud->change_field_type('password', 'password');

            $crud->callback_edit_field('password', array($this, 'set_password_input_to_empty'));
            $crud->callback_add_field('password', array($this, 'set_password_input_to_empty'));

            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
            $crud->callback_before_update(array($this, 'encrypt_password_callback'));

            $crud->callback_read_field('status', function ($value, $primary_key) {
                return ((int)$value === 1) ? 'Active' : 'Inactive';
            });

            $crud->unset_read_fields('password', 'code', 'created_at', 'updated_at', 'deleted_at');
            $crud->unset_jquery();
            $crud->unset_print();
            $crud->unset_clone();


            $crud->set_relation_n_n('roles', 'roles_acl_users', 'roles', 'user_id', 'role_id', 'display_name');

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['hide_admin_forms'] = TRUE;
            $this->data_template['script'] = $this->load->view('admin/s_acl_users', NULL, TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function encrypt_password_callback($post_array) {

        //Encrypt password only if is not empty. Else don't change the password to an empty field
        if (!empty($post_array['password'])) {
            $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        }
        else {
            unset($post_array['password']);
        }

        return $post_array;

    }

    function set_password_input_to_empty() {
        return "<input id=\"field-password\" type=\"password\" name=\"password\" class=\"form-control\" value=\"\" />";

    }

}
