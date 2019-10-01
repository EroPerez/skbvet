<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Illness extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL, $accesos, $auth;

    function __construct() {

        parent::__construct();
//        if (!$this->session->userdata('autenticado')) {
//            redirect(site_url('Init'));
//        }

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_tblveterinarians', 'M_tblillnessnames', 'M_casedetails', 'M_caseillnesses', 'M_livestock', 'M_farms', 'M_tblcountries', 'M_transfers', 'M_tbltreatmentnames', 'M_bills'));
//        $this->data_template['accesos'] = $this->session->userdata('conf_acc');
//        $accesos = $this->data_template['accesos']['case_management']['allow_intro_edit'];
//        
//        
        //new authentication method
        $this->auth->route_access();

    }

    function index($action, $recn = NULL) {

        $data['title'] = 'Case Information';
        /* $data['sizeunits']= $this->M_tblunits->get_all_Units();
          $data['parish'] = $this->M_tbldistricts->get_all_Districts();
          $data['contry'] = $this->M_tblcountries->get_all_Countries();
          $data['species'] = $this->M_tblspecies->get_all_Species();
         */
        $data['pag'] = 'illness';
        $data['illness_n'] = $this->M_tblillnessnames->get_all_Illnessname();
        $data['treatname'] = $this->M_tbltreatmentnames->get_all_TreatmentNames();
//        $this->data_template['accesos'] = $this->session->userdata('conf_acc');

        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_illness', $operation, TRUE);
        $this->render('pages/illness_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function case_list() {

        $data = array();
        try {
            $data['title'] = 'Case Information List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tblcasedetails');
            $crud->set_subject('Case Information');
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_jquery();
            $crud->set_relation('farmRecn', 'tblfarms', 'farmName', NULL, 'recn ASC');
            $crud->set_relation('livestockRecn', 'tbllivestock', 'IDNO', NULL, 'recn ASC');
            $crud->set_relation('vetRecn', 'tblveterinarians', 'name', NULL, 'recn ASC');
            $crud->columns('caseNumber', 'dateOfCase', 'farmRecn', 'livestockRecn', 'vetRecn', 'billTotal');
            $crud->display_as('caseNumber', 'Case Number')
              ->display_as('dateOfCase', 'Date Of Case')
              ->display_as('farmRecn', 'Farm')
              ->display_as('livestockRecn', 'Livestock ID')
              ->display_as('vetRecn', 'Veterinarian')
              ->display_as('billTotal', 'Bill Total')
              ->order_by('recn', 'desc');

            $crud->callback_column('dateOfCase', array($this, 'dateOfCase_callback'));
            $crud->callback_column('billTotal', array($this, 'billTotal_callback'));

            $crud->add_action('View', '', '', 'ui-icon-document', array($this, 'crud_view_action'));
            $crud->add_action('Edit', '', '', 'ui-icon-pencil', array($this, 'crud_edit_action'));
            $crud->callback_delete(array($this, 'delete_case_callback'));

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_illness', array('action' => '', 'recn' => ''), TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function crud_edit_action($primary_key, $row) {
        return site_url('illness/case/edit') . '/' . $row->recn;

    }

    function crud_view_action($primary_key, $row) {
        return site_url('illness/case/read') . '/' . $row->recn;

    }

    function delete_case_callback($primary_key) {
//        $caseDetails = $this->M_casedetails->get_a_casedetails($primary_key);
        $this->M_caseillnesses->del_caseillnesses_by($primary_key);
        return $this->M_casedetails->del_casedetails($primary_key);

    }

    function dateOfCase_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');

    }

    function billTotal_callback($value, $row) {

        return '$' . \round($value * 100) / 100;

    }

    function case_forward() {


        $page = $this->input->post('page');
        $all_case = $this->M_casedetails->get_casedetails();

        if ($page + 1 > count($all_case) || $page <= 0) {
            $page = 1;
        }
        else {
            $page = $page + 1;
        }
        $registers_case = $this->M_casedetails->get_casedetails_pagination($page - 1);

        $results = $this->get_case_data($registers_case);



        $results['page'] = $page;

        print_r(json_encode($results));

    }

///////////////////////////////////// 
    /* Navegar backwards por la base */
    function case_backward() {


        $page = $this->input->post('page');

        $all_case = $this->M_casedetails->get_casedetails();

        if ($page - 1 <= 0 || $page > count($all_case)) {

            $page = count($all_case);
        }
        else {
            $page = $page - 1;
        }


        $registers_case = $this->M_casedetails->get_casedetails_pagination($page - 1);
        $specimen_permits = $this->get_case_data($registers_case);

        $specimen_permits['page'] = $page;
        print_r(json_encode($specimen_permits));

    }

////////////////////////////////////////////////////////////////
/////////////MOSTRAR TODA DATA OF FARMER ////////////////////////////////
    function get_case_data($case) {
        $registers_case = $case;
        $registers_farm = array();
        $regiter_livestock = array();
        $veterinary = array();
        if (\count($case) > 0) {
            $registers_farm = $this->M_farms->get_a_farms($case[0]['farmRecn']);
            // print_r($registers_farm);
            $regiter_livestock = (count($registers_farm) > 0) ? $this->M_livestock->get_a_Livestock_by_farm($registers_farm[0]['recn']) : array();

            $veterinary = $this->M_tblveterinarians->get_one_Veterinarians($registers_case[0]['vetRecn']);
        }
        $result = array('caseillness' => $registers_case, 'illness' => array(), 'livestock' => $regiter_livestock, 'farm' => $registers_farm, 'veterinarian' => $veterinary);

        return $result;

    }

    function listar_illness() {

        $idcase = $this->input->post('recn');
        $illness = $this->M_caseillnesses->get_illness_by_case($idcase);

        print_r(json_encode($illness));

    }

    function edit_illness() {

        $id = $this->input->post('recnlive');
        $res = $this->M_caseillnesses->get_a_caseillnesses($id);

        print_r(json_encode($res));

    }

    function add_illness() {
        $data['d_recn'] = $this->input->post('recnillness');
        $data['d_caseRecn'] = $this->input->post('caseid');
        $data['d_illnessRecn'] = $this->input->post('illness');
        $data['d_dateOfIllness'] = $this->input->post('illness_dateadd');
        $data['d_summary'] = $this->input->post('clinical_summary');
        $data['d_treatmentRecn'] = $this->input->post('treatment');
        $data['d_dateOfTreatment'] = $this->input->post('treatment_dateadd');
        $data['d_Withdrawal'] = $this->input->post('withdrawl_period');
        $data['d_response'] = $this->input->post('response_treatment');

        $res = FALSE;
        if ($this->input->post('addillness') === 'true') {
            $res = $this->M_caseillnesses->set_caseillnesses($data);
        }
        else
            $res = $this->M_caseillnesses->update_caseillnesses($data);

        echo $res;

    }

    function delete_illness() {

        $idlive = $this->input->post('reclive');
        $res = $this->M_caseillnesses->del_caseillnesses($idlive);
        echo $res;

    }

    function farm() {
        $html_f = '';

        $farm = $this->M_farms->get_farms();

        foreach ($farm as $value) {

            $html_f .= "<option value='" . $value['recn'] . "'>" . $value['farmName'] . "</option>";
        }

        print_r($html_f);

    }

    function livestock_for_farm() {
        $html_l = '';
        $recfarm = $this->input->post('recfarm');
        $livestock = $this->M_livestock->get_a_Livestock_by_farm($recfarm);
        foreach ($livestock as $value) {

            $html_l .= "<option value='" . $value['recn'] . "'>" . $value['IDNO'] . "</option>";
        }

        print_r($html_l);

    }

    function veterinary() {
        $html_v = '';
        $veterinary = $this->M_tblveterinarians->get_all_Veterinarians();
        foreach ($veterinary as $value) {
            $html_v .= "<option value='" . $value['recn'] . "'>" . $value['name'] . "</option>";
        }
        print_r($html_v);

    }

    function case_add_edit() {
//        if ($this->session->userdata('autenticado')) {
        $datos = array();
        $this->form_validation->set_rules('case_datepicker6', 'case_datepicker6', 'required');
        $this->form_validation->set_rules('case_CaseNo', 'case_CaseNo', 'required');
        $this->form_validation->set_rules('case_farm', 'case_farm', 'required');
        //  $this->form_validation->set_rules('case_livestockid', 'case_livestockid', 'required');
        $this->form_validation->set_rules('case_veterinarian', 'case_veterinarian', 'required');

        if ($this->form_validation->run() == FALSE) {
            $estado = array("state" => "All case data are required.", 'success' => FALSE);
            print_r(json_encode($estado));
        }
        else {
            date('F j, Y \a\t g:i A', strtotime($this->input->post('case_datepicker6')));

            $datoscase = array(
              'd_recn' => $this->input->post('reccase'),
              'd_dateOfCase' => date('Y-m-d', strtotime($this->input->post('case_datepicker6'))),
              'd_caseNumber' => $this->input->post('case_CaseNo'),
              'd_farmRecn' => $this->input->post('case_farm'),
              'd_livestockRecn' => $this->input->post('case_livestockid'),
              'd_vetRecn' => $this->input->post('case_veterinarian'),
              'd_billTotal' => $this->input->post('billTotal')
              //'d_bill_total' => 0
              //$mobile_home = $this->input->post('farmer_mobile_home')
            );
            /// IDENTIFICAR PARA HACER UN EDIT O UN ADD/////
            if ($this->input->post('edit') === '0') {
                $datoscase['d_billTotal'] = 0;
                $id_caseRecn = $this->M_casedetails->set_casedetails($datoscase);
                $estado = array("state" => "Your case has been successfully stored into the database.", "recn" => $id_caseRecn, 'success' => TRUE);
                print_r(json_encode($estado));
            }
            else {
                $id_caseRecn = $this->M_casedetails->update_casedetails($datoscase);
                $estado = array("state" => "The case has been successfully updated into the database.", "recn" => $id_caseRecn, 'success' => TRUE);
                print_r(json_encode($estado));
            }
        }
//        }
//        else {
//            $estado = array("state" => "Unable to add or edit case.", 'success' => FALSE);
//            print_r(json_encode($estado));
//        }

    }

    function delete_case() {
        $idcase = $this->input->post('recncase');
        $result_ill = $this->M_caseillnesses->get_illness_by_case($idcase);
        if (count($result_ill) > 0) {
            $r = array(
              'let' => 'You cannot delete this case, because there are illnesses associated.',
              'state' => FALSE
            );           
        }
        else {
            $this->M_casedetails->del_casedetails($idcase);
            $r = array(
              'let' => 'The case has been successfully deleted from the database.',
              'state' => TRUE
            );          
        }

        print_r(json_encode($r));

    }

    function add_trans() {
        $data['d_recn'] = $this->input->post('recntrans');
        $data['d_caseRecn'] = $this->input->post('caseid');
        $data['d_amount'] = $this->input->post('amount_trans');
        $data['d_type'] = $this->input->post('type_trans');
        $data['d_transactionDate'] = date('Y-m-d', strtotime($this->input->post('trans_dateadd')));
        $data['d_balance'] = 0;

        if ($this->input->post('addtrans') === 'true') {
            $billarray = $this->M_bills->get_bills_by_case($this->input->post('caseid'), 'desc');
            if (count($billarray) == 0) { //Para cuando es la primera transaccion
                $balance = 0;
                $bill = '0';
            }
            else {
                $balance = $billarray[0]['balance'];
                $bill = $billarray[0]['transactionDate'];
            }
            if ($data['d_transactionDate'] > $bill) {


                if ($this->input->post('type_trans') == '1') {
                    $data['d_balance'] = floatval($balance) + floatval($this->input->post('amount_trans'));
                }
                else
                    $data['d_balance'] = floatval($balance) - floatval($this->input->post('amount_trans'));

                $this->M_bills->set_bills($data);

                print_r(json_encode('Added new transaction'));
            }
            else
                print_r(json_encode('Error, new Transaction date must be before last transaction date.'));
        }else {

            $this->M_bills->update_bills($data);

            // print_r(json_encode('Update transaction'));
            // $res = $this->listar_trans();

            print_r(json_encode('Update transaction'));
        }

    }

    function listar_trans() {

        $idcase = $this->input->post('recn');
        $trans = $this->M_bills->get_bills_by_case($idcase, 'asc');

        print_r(json_encode($trans));

    }

    function delete_trans() {

        $idlive = $this->input->post('reclive');
        $this->M_bills->del_bills($idlive);
        $res = $this->listar_trans();

        echo $res;

    }

    function validar_fecha_trans($idcase, $fecha_act) {

        $result_trans = $this->M_bills->get_bills_by_case($idcase, 'desc');
        if (count($result_trans) > 0) {
            $date1 = new DateTime($result_trans[0]['transactionDate']);
            $date2 = new DateTime($fecha_act);

            if ($date1 < $date2)
                return TRUE;
            else
                return FALSE;
        }
        else
            return TRUE;

    }

    function recalculate_bill() {
        $v = 0;
        $idcase = $this->input->post('recn');


        $result_bill = $this->M_bills->get_bills_by_case($idcase, 'desc');

        foreach ($result_bill as $key => $value) {
            if ($value['type'] === '1') {
                $v += $value['amount'];
            }
        }

        $result_case = $this->M_casedetails->get_a_casedetails($idcase);
        $data['d_recn'] = $idcase;
        $data['d_caseNumber'] = $result_case[0]['caseNumber'];
        $data['d_dateOfCase'] = $result_case[0]['dateOfCase'];
        $data['d_farmRecn'] = $result_case[0]['farmRecn'];
        $data['d_livestockRecn'] = $result_case[0]['livestockRecn'];
        $data['d_vetRecn'] = $result_case[0]['vetRecn'];

        $data['d_billTotal'] = $v;
        $this->M_casedetails->update_casedetails($data);


        print_r(json_encode($v));

    }

    function case_search() {
        $name = $this->input->post('name');
        $datos_case = array('d_caseNumber' => $name, 'd_dateOfCase' => $name, 'd_livestockRecn' => $name);
        $result = $this->M_casedetails->find_casedetails($datos_case);
        //print_r($result);
        print_r(json_encode($this->get_case_data($result)));

    }

    function case_search_by_livestock() {
        $name = $this->input->post('name');
        $datos_case = array('d_livestockRecn' => $name);
        $result = $this->M_casedetails->find_casedetails($datos_case);
        //print_r($result);

        print_r(json_encode($this->get_case_data($result)));

    }

    /////////////////////////////////////////////////
/////Get by ID a farmer////////
    function case_get_by_id() {

        $id = $this->input->post('reccase');
        $result = $this->M_casedetails->get_a_casedetails($id);

        print_r(json_encode($this->get_case_data($result)));

    }

}

//End of  class   