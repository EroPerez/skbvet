<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Surveillance extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('autenticado')) {
            redirect(site_url('Init'));
        } else {

            $this->use_acc = $this->auth_val($this->session->userdata($this->session->userdata('rol')));
        }

        $this->load->library('Form_validation');
        $this->load->helper('my_uri');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_surveillance', 'M_farms', 'M_tbltestnames', 'M_livestock', 'M_surveillancedetails'));
    }

    function index($action, $recn = NULL) {

        $data['title'] = 'Surveillance Data';
        $data['pag'] = 'surveillance';
        $data['farms'] = $this->M_farms->get_farms();
        $data['tests'] = $this->M_tbltestnames->get_all_testnames();
        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_surveillance', $operation, TRUE);
        $this->render('pages/surveillance_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function Surveillance_list() {

        $data = array();
        try {
            $data['title'] = 'Surveillance Data List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();
//            $crud->where('tradeType', 2);

            $crud->set_theme('datatables');
            $crud->set_table('tblsurveillance');
            $crud->set_subject('Surveillance Data');
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_jquery();
            $crud->set_relation('farmRecn', 'tblfarms', 'farmName');
            $crud->set_relation('testRecn', 'tbltestnames', 'name');
            $crud->display_as('farmRecn', 'Farm Name');
            $crud->display_as('dateOfSurveillance', 'Date Of Surveillance');
            $crud->display_as('testRecn', 'Test Type');

            $crud->callback_column('dateOfSurveillance', array($this, 'dateOfSurveillance_callback'));

            $crud->add_action('View', '', '', 'ui-icon-document', array($this, 'crud_view_action'));
            $crud->add_action('Edit', '', '', 'ui-icon-pencil', array($this, 'crud_edit_action'));
            $crud->callback_delete(array($this, 'delete_callback'))
                    ->order_by('recn', 'desc');

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_surveillance', array('action' => '', 'recn' => ''), TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function crud_edit_action($primary_key, $row) {
        return site_url('surveillance/data/edit') . '/' . $primary_key;
    }

    function crud_view_action($primary_key, $row) {
        return site_url('surveillance/data/read') . '/' . $primary_key;
    }

    function delete_callback($primary_key) {
        $this->M_surveillancedetails->del_surveillancedetails_by($primary_key);
        return $this->M_surveillance->del_surveillance($primary_key);
    }

    function dateOfSurveillance_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');
    }

    function create_new() {

        $farmRecn = $this->input->post('surv_farm');
        $testRecn = $this->input->post('srv_test');
        $dateOfSurveillance = $this->input->post('surv_date');
        $edit = $this->input->post('edit');
        $recn = $this->input->post('recn');

        if (!isset($farmRecn) || !isset($testRecn) || !isset($dateOfSurveillance)) {
            $estado = array("state" => "All data are required", 'success' => FALSE);
            print_r(json_encode($estado));
        } else {

            $id = false;
            if ($edit == 0) {
                $id = $this->M_surveillance->set_surveillance(array('farmRecn' => $farmRecn, 'testRecn' => $testRecn, 'dateOfSurveillance' => $dateOfSurveillance));
            } else {
                $id = $this->M_surveillance->update_surveillance(array('farmRecn' => $farmRecn, 'testRecn' => $testRecn, 'dateOfSurveillance' => $dateOfSurveillance, 'recn' => $recn));
            }
            $estado = array();

            if ($id > 0) {
                $estado = array("state" => "Your data has been successfully stored into the database.", "id" => $id, 'success' => TRUE);
            } else {
                $estado = array("state" => "The data you had insert may not be saved.", "id" => $id, 'success' => FALSE);
            }

            print_r(json_encode($estado));
        }
    }

    function farm() {
        $html_f = '';

        $farm = $this->M_farms->get_farms();

        foreach ($farm as $value) {

            $html_f .= "<option value='" . $value['recn'] . "'>" . $value['farmName'] . "</option>";
        }

        print_r($html_f);
    }

    function tests() {
        $html_f = '';

        $test = $this->M_tbltestnames->get_all_testnames();

        foreach ($test as $value) {

            $html_v .= "<option value='" . $value['recn'] . "'>" . $value['name'] . "</option>";
        }

        print_r($html_v);
    }

    function animalByFarm() {
        $html = '';
        $recn = $this->input->post('recn');
        $animals = $this->M_livestock->get_a_Livestock_by_farm($recn);

        foreach ($animals as $value) {

            $html .= "<option value='" . $value['recn'] . "'>" . $value['IDNO'] . "</option>";
        }

        print_r($html);
    }

    function surv_animal() {
        $recnsrv = $this->input->post('recnsrv');
        $animal_farm = $this->input->post('animal_farm');
        $test_result = $this->input->post('test_result');
        $recn = $this->input->post('idedit');
        $edit = $this->input->post('edit');
        $id = 0;
        if ($edit == 0) {
            $id = $this->M_surveillancedetails->set_surveillancedetails(array('livestockRecn' => $animal_farm, 'testResult' => $test_result, 'surveillanceRecn' => $recnsrv));
        } else
            $id = $this->M_surveillancedetails->update_surveillancedetails(array('livestockRecn' => $animal_farm, 'testResult' => $test_result, 'surveillanceRecn' => $recnsrv, 'recn' => $recn));

        $estado = array();

        if ($id > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.", "status" => TRUE);
        } else {
            $estado = array("state" => "The data you had insert may not be saved.", "status" => FALSE);
        }

        print_r(json_encode($estado));
    }

    function liveanimalBySurveillance() {
        $recn = $this->input->post('recn');
        $animals = $this->M_surveillance->liveanimalBySurveillance($recn);
        print_r(json_encode($animals));
    }

    function delete_tradeliveanimaldetails() {
        $id = $this->input->post('recnlive');
        $recn_trade_live_animal_delete = $this->M_surveillancedetails->del_surveillancedetails($id);

        if ($recn_trade_live_animal_delete > 0)
            print_r(json_encode(array("state" => 'Your data has been successfully deleted from the database.')));
        else
            print_r(json_encode(array("state" => 'Your data has not been deleted from the database.')));

        return;
    }

    function edit_tradeliveanimaldetails() {
        $id = $this->input->post('recnlive');
        $res = $this->M_surveillancedetails->get_a_surveillance_edit($id);

        print_r(json_encode($res));
    }

    function forward() {
        $page = $this->input->post('page');

        $all_surveillance = $this->M_surveillance->get_surveillance();

        if ($page + 1 > count($all_surveillance) || $page <= 0) {
            $page = 1;
        } else {
            $page = $page + 1;
        }


        $srvSelect = $this->M_surveillance->get_surveillance_pagination($page - 1);
        $nomenclator = $this->get_surv_data($srvSelect);


        $nomenclator['page'] = $page;


        print_r(json_encode($nomenclator));
    }

    function back() {
        $page = $this->input->post('page');

        $all_surveillance = $this->M_surveillance->get_surveillance();

        if ($page - 1 <= 0 || $page > count($all_surveillance)) {

            $page = count($all_surveillance);
        } else {
            $page = $page - 1;
        }

        $srvSelect = $this->M_surveillance->get_surveillance_pagination($page - 1);
        $nomenclator = $this->get_surv_data($srvSelect);


        $nomenclator['page'] = $page;


        print_r(json_encode($nomenclator));
    }

    function get_surv_data($srvSelect) {

        $animals = count($srvSelect) ? $this->M_surveillance->liveanimalBySurveillance($srvSelect[0]['recn']) : array();
        $result = array('surveillance' => $srvSelect, 'animals' => $animals);

        return $result;
    }

    function delete() {
        $id = $this->input->post('recn');
        $delete = $this->M_surveillance->del_surveillance($id);

        if ($delete > 0) {
            print_r(json_encode(array("status" => TRUE, "state" => 'Your data has been successfully deleted from the database.')));
        } else {
            print_r(json_encode(array("status" => FALSE, "state" => 'Your data has not been deleted from the database.')));
        }
    }

    function search() {
        $name = $this->input->post('name');
        $data = array('d_farmRecn' => $name, 'd_testRecn' => $name, 'd_dateOfSurveillance' => $name);

        $srvSelect = $this->M_surveillance->find_surveillance($data);
        $nomenclator = $this->get_surv_data($srvSelect);
        print_r(json_encode($nomenclator));
    }

    function surv_get_by_id() {
        $recn = $this->input->post('recn');

        $srvSelect = $this->M_surveillance->get_a_surveillance($recn);
        $nomenclator = $this->get_surv_data($srvSelect);
        print_r(json_encode($nomenclator));
    }

}
