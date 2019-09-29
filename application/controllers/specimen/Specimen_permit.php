<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Specimen_Permit extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL, $accesos, $auth;

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('autenticado')) {
            redirect(site_url('Init'));
        }
        $this->auth = $this->session->userdata('autenticado');
        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_tblcountries', 'M_specimenpermit'));


        $this->data_template['accesos'] = $this->session->userdata('conf_acc');
        $accesos = $this->data_template['accesos']['farm_farmers']['allow_intro_edit'];
    }

    function index($action, $recn = NULL) {

        $data['title'] = 'Specimen Permits';
        $data['destination'] = $this->M_tblcountries->get_all_Countries();
        $data['pag'] = 'specimen';
        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_specimen', $operation, TRUE);

        $this->render('pages/specimen_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function Specimen_Permit_list() {

        $data = array();
        try {
            $data['title'] = 'Specimen Permits List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();
//            $crud->where('tradeType', 2);

            $crud->set_theme('datatables');
            $crud->set_table('tblspecimenpermit');
            $crud->set_subject('Specimen Permits');
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_jquery();
            $crud->set_relation('destination', 'tblcountries', 'name');
            $crud->display_as('dateIssued', 'Date Issued');

            $crud->callback_column('dateIssued', array($this, 'dateIssued_callback'));
            $crud->callback_column('fee', array($this, 'fee_callback'));
            $crud->callback_column('weight', array($this, 'weight_callback'));

            $crud->add_action('View', '', '', 'ui-icon-document', array($this, 'crud_view_action'));
            $crud->add_action('Edit', '', '', 'ui-icon-pencil', array($this, 'crud_edit_action'));
            $crud->callback_delete(array($this, 'delete_callback'))
                    ->order_by('recn', 'desc');

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_specimen', array('action' => '', 'recn' => ''), TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function crud_edit_action($primary_key, $row) {
        return site_url('specimen/permit/edit') . '/' . $primary_key;
    }

    function crud_view_action($primary_key, $row) {
        return site_url('specimen/permit/read') . '/' . $primary_key;
    }

    function delete_callback($primary_key) {

        return $this->M_specimenpermit->del_specimenpermit($primary_key);
    }

    function dateIssued_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');
    }

    function fee_callback($value, $row) {

        return '$' . \round($value * 100) / 100;
    }

    function weight_callback($value, $row) {

        return (\round($value * 100) / 100) . 'Kg';
    }

    /////////////////////////////////////////////////////
    ///////ADD Specimen_Permit //////////////////////////////////// 
    function specimen_permit_add_edit() {
        if ($this->session->userdata('autenticado')) {
            $datos = array();
            $this->form_validation->set_rules('specimen_name', 'specimen_name', 'required');
            $this->form_validation->set_rules('specimen_sender', 'specimen_sender', 'required');
            $this->form_validation->set_rules('specimen_reciever', 'specimen_reciever', 'required');
            $this->form_validation->set_rules('sele_specimen_destination', 'sele_specimen_destination', 'required');
            $this->form_validation->set_rules('specimen_weight', 'specimen_weight', 'required');
            $this->form_validation->set_rules('date_issued_specimen', 'date_issued_specimen', 'required');
            $this->form_validation->set_rules('specimen_fee', 'specimen_fee', 'required');


            if ($this->form_validation->run() == FALSE) {
                $estado = array("state" => "All data are required", 'success' => FALSE);
                print_r(json_encode($estado));
            } else {
                date('F j, Y \a\t g:i A', strtotime($this->input->post('date_issued_specimen')));

                $datos_specimen = array(
                    'd_recn' => $this->input->post('specimen_recn'),
                    'd_name' => $this->input->post('specimen_name'),
                    'd_sender' => $this->input->post('specimen_sender'),
                    'd_reciever' => $this->input->post('specimen_reciever'),
                    'd_destination' => $this->input->post('sele_specimen_destination'),
                    'd_weight' => $this->input->post('specimen_weight'),
                    'd_dateIssued' => date('Y-m-d', strtotime($this->input->post('date_issued_specimen'))),
                    'd_fee' => $this->input->post('specimen_fee')
                );
                /// IDENTIFICAR PARA HACER UN EDIT O UN ADD
                $specimen_recn = -1;
                if ($this->input->post('edit') === '0') {
                    $specimen_recn = $this->M_specimenpermit->set_specimenpermit($datos_specimen);
                } else {
                    $specimen_recn = $this->M_specimenpermit->update_specimenpermit($datos_specimen);
                }

                if ($specimen_recn > 0) {
                    $estado = array("state" => "Your data has been successfully stored into the database.", "id" => $specimen_recn, 'success' => TRUE);
                } else {
                    $estado = array("state" => "The data you had insert may not be saved.", "id" => $specimen_recn, 'success' => FALSE);
                }

                print_r(json_encode($estado));
            }
        } else {
            $estado = array("success" => FALSE, "state" => "Access denied!!!");
            print_r(json_encode($estado));
        }
    }

    //////////////////////////////////////////////
    /* eliminar Specimen_Permit */
    function specimen_permit_delete() {

        $specimen_recn = $this->input->post('specimen_recn');

        $recn_specimen_delete = $this->M_specimenpermit->del_specimenpermit($specimen_recn);
        if ($recn_specimen_delete > 0) {
            print_r(json_encode(array("status" => TRUE, "state" => 'Your data has been successfully deleted from the database.')));
        } else {
            print_r(json_encode(array("status" => FALSE, "state" => 'Your data has not been deleted from the database.')));
        }
    }

    ////////////////////////////////////////////////
    ///Navegar forwards por la base//
    function specimen_permit_forward() {

        $page = $this->input->post('page');
        $all_specimen = $this->M_specimenpermit->get_specimenpermit();

        if ($page + 1 > count($all_specimen) || $page <= 0) {
            $page = 1;
        } else {
            $page = $page + 1;
        }
        $registers_specimen = $this->M_specimenpermit->get_specimenpermit_pagination($page - 1);
        $specimen_permits = $this->get_Specimen_Permit_data($registers_specimen);



        $specimen_permits['page'] = $page;

        print_r(json_encode($specimen_permits));
    }

///////////////////////////////////// 
    /* Navegar backwards por la base */
    function specimen_permit_backward() {


        $page = $this->input->post('page');

        $all_specimen = $this->M_specimenpermit->get_specimenpermit();

        if ($page - 1 <= 0 || $page > count($all_specimen)) {

            $page = count($all_specimen);
        } else {
            $page = $page - 1;
        }


        $registers_specimen = $this->M_specimenpermit->get_specimenpermit_pagination($page - 1);
        $specimen_permits = $this->get_Specimen_Permit_data($registers_specimen);



        $specimen_permits['page'] = $page;

        print_r(json_encode($specimen_permits));
    }

////////////////////////////////////////////////////////////////
/////////////MOSTRAR TODA DATA OF Specimen_Permit ////////////////////////////////
    function get_Specimen_Permit_data($specimen) {

        return array('specimen' => $specimen);
    }

/////////////////////////////////////////////////
/////search a Specimen_Permit////////
    function specimen_permit_search() {

        $name = $this->input->post('name');
        $datos_specimen = array('d_name' => $name,
            'd_sender' => $name,
            'd_reciever' => $name,
            'd_destination' => $name,
            'd_weight' => $name,
            'd_fee' => $name,
            'd_dateIssued' => $name);


        $result = $this->M_specimenpermit->find_specimenpermit($datos_specimen);
        $specimen_permits = $this->get_Specimen_Permit_data($result);

        print_r(json_encode($specimen_permits));
    }

/////////////////////////////////////////////////
/////search a Specimen_Permit////////
    function specimen_get_by_id() {

        $recn = $this->input->post('recn');

        $result = $this->M_specimenpermit->get_a_specimenpermit($recn);
        $specimen_permits = $this->get_Specimen_Permit_data($result);

        print_r(json_encode($specimen_permits));
    }

////////////////////////////////////////////////////////////////
///// listar country ///////
    function country() {

        $result = $this->M_tblcountries->get_Countries_by_type(2);
        print_r(json_encode($result));
    }

}

/* end de la class*/
   
