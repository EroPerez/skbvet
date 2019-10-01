<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Permissions Controller
 *
 * @author Michel
 */
class Permissions extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {
        parent::__construct();
       
        //new authentication method
        $this->auth->route_access();

    }

    public function setup() {
        $data = array();
        try {
            $data['title'] = 'Pemissions';
            $data['pag'] = 'user';

            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('roles');
            $crud->set_subject('role');
            $crud->columns('name', 'display_name', 'description');
            $crud->fields('name', 'display_name', 'description',  'permissions');
            $crud->required_fields('name', 'display_name');
           
            $crud->callback_read_field('status', function ($value, $primary_key) {
                return ($value == 1) ? 'Active' : 'Inactive';
            });

            $crud->unset_read_fields('created_at', 'updated_at', 'deleted_at');
            $crud->unset_jquery();
            $crud->unset_print();

            $crud->set_relation_n_n('permissions', 'permission_roles', 'permissions', 'role_id', 'permission_id', 'display_name','priority');

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['hide_admin_forms'] = TRUE;
            $this->data_template['script'] = $this->load->view('admin/s_permissions', NULL, TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

}
