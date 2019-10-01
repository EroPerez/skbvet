<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comimp extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {

        parent::__construct();
//        if (!$this->session->userdata('autenticado')) {
//            redirect(site_url('Init'));
//        } else {
//
//            $this->use_acc = $this->auth_val($this->session->userdata($this->session->userdata('rol')));
//        }

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_tbltraders', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_tradeproducts', 'M_tradeproductsdetails', 'M_tblcommodities'));

        //new authentication method
        $this->auth->route_access();

    }

    function index($action, $recn = NULL) {
        $data['title'] = 'Commodity Licence (imp)';
        $data['trader'] = $this->M_tbltraders->get_Traders_by_type(1);
        $data['sizeunits'] = $this->M_tblunits->get_all_Units();
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['country'] = $this->M_tblcountries->get_all_Countries();
        $data['commodity'] = $this->M_tblcommodities->get_all_Commodities();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['pag'] = 'comimp';
        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_comimp', $operation, TRUE);
        $this->render('pages/comimp_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function Comimp_list() {

        $data = array();
        try {
            $data['title'] = 'Commodities Licences(Imp) List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();
            $crud->where('tradeType', 1);

            $crud->set_theme('datatables');
            $crud->set_table('tbltradeproducts');
            $crud->set_subject('Licence (Imp)');
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_jquery();
            $crud->set_relation('FarmRecn', 'tbltraders', 'name');
            $crud->columns('tradeType', 'licenceNo', 'dateOfLicence', 'FarmRecn', 'fee');
            $crud->display_as('licenceNo', 'Licence No')
              ->display_as('dateOfLicence', 'Date Of Licence')
              ->display_as('FarmRecn', 'Trader')
              ->display_as('tradeType', 'Type')
              ->order_by('recn', 'desc');

            $crud->callback_column('dateOfLicence', array($this, 'dateOfLicence_callback'));
            $crud->callback_column('fee', array($this, 'fee_callback'));
            $crud->callback_column('tradeType', array($this, 'tradeType_callback'));

            $crud->add_action('View', '', '', 'ui-icon-document', array($this, 'crud_view_action'));
            $crud->add_action('Edit', '', '', 'ui-icon-pencil', array($this, 'crud_edit_action'));
            $crud->callback_delete(array($this, 'delete_callback'));

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_comimp', array('action' => '', 'recn' => ''), TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function crud_edit_action($primary_key, $row) {
        return site_url('comimp/licence/edit') . '/' . $row->recn;

    }

    function crud_view_action($primary_key, $row) {
        return site_url('comimp/licence/read') . '/' . $row->recn;

    }

    function delete_callback($primary_key) {
        $this->M_tradeproductsdetails->del_tradeproductsdetails_by($primary_key);
        return $this->M_tradeproducts->del_tradeproducts($primary_key);

    }

    function dateOfLicence_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');

    }

    function fee_callback($value, $row) {

        return '$' . \round($value * 100) / 100;

    }

    function tradeType_callback($value, $row) {
        return 'Imp';

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    /* Navegar backwards por la base */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function tradeproducts_backward() {
//        $idtradeproducts = $this->input->post('recn') - 1;
//        $a = 1;
//        $all_tradeproducts = $this->M_tradeproducts->get_tradeproducts_impexp($a);
//        $ult_reg = end($all_tradeproducts);
//        $first_reg = reset($all_tradeproducts);
//
//        if ($idtradeproducts < 0 || $idtradeproducts < $first_reg['recn']) {
//            $idtradeproducts = $ult_reg['recn'];
//            $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//        } else {
//
//            $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//
//            while ($registers_tradeproducts === array()) {
//
//                $idtradeproducts = $idtradeproducts - 1;
//                $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//            }
//        }
//
//        print_r(json_encode($this->get_tradeproducts_data($registers_tradeproducts)));
        $page = $this->input->post('page');
        $a = 1;
        $all_tradeproducts = $this->M_tradeproducts->get_tradeproducts_impexp($a);


        if ($page - 1 <= 0 || $page > count($all_tradeproducts)) {

            $page = count($all_tradeproducts);
        }
        else {
            $page = $page - 1;
        }
        $registers_tradeproducts = $this->M_tradeproducts->get_tradeproducts_pagination($page - 1, $a);
        $tradeproducts_and_details = $this->get_tradeproducts_data($registers_tradeproducts);


        $tradeproducts_and_details['page'] = $page;
        print_r(json_encode($tradeproducts_and_details));

    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function tradeproducts_forward() {
//        $idtradeproducts = $this->input->post('recn') + 1;
//        $a = 1;
//        $all_tradeproducts = $this->M_tradeproducts->get_tradeproducts_impexp($a);
//        $ult_reg = end($all_tradeproducts);
//        $first_reg = reset($all_tradeproducts);
//
//        if ($idtradeproducts > $ult_reg['recn']) {
//            $idtradeproducts = $first_reg['recn'];
//            $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//        } else {
//
//            $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//
//            while ($registers_tradeproducts === array()) {
//
//                $idtradeproducts = $idtradeproducts + 1;
//                $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($idtradeproducts);
//            }
//        }
//
//        print_r(json_encode($this->get_tradeproducts_data($registers_tradeproducts)));

        $page = $this->input->post('page');
        $a = 1;
        $all_tradeproducts = $this->M_tradeproducts->get_tradeproducts_impexp($a);

        if ($page + 1 > count($all_tradeproducts) || $page <= 0) {
            $page = 1;
        }
        else {
            $page = $page + 1;
        }
        $registers_tradeproducts = $this->M_tradeproducts->get_tradeproducts_pagination($page - 1, $a);
        $tradeproducts_and_details = $this->get_tradeproducts_data($registers_tradeproducts);


        $tradeproducts_and_details['page'] = $page;
        print_r(json_encode($tradeproducts_and_details));

    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /* ADICIONAR UN TRADEPRODUCT */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    function tradeproducts_add_edit() {
        $datos = array();
        $this->form_validation->set_rules('comimp_licenceNo', 'comimp_licenceNo', 'required');
        $this->form_validation->set_rules('comimp_date', 'comimp_date', 'required');
        $this->form_validation->set_rules('comimp_trader', 'comimp_trader', 'required');
        $this->form_validation->set_rules('comimp_fee', 'comimp_fee', 'required');

        if ($this->form_validation->run() == FALSE) {
            $estado = array("state" => "All licence data are requiered.", 'success' => FALSE);
            print_r(json_encode($estado));
        }
        else {
            date('F j, Y \a\t g:i A', strtotime($this->input->post('comimp_date')));

            $datostradeproducts = array(
              'd_recn' => $this->input->post('comimp_recn'),
              'd_dateOfLicence' => date('Y-m-d', strtotime($this->input->post('comimp_date'))),
              'd_licenceNo' => $this->input->post('comimp_licenceNo'),
              'd_FarmRecn' => $this->input->post('comimp_trader'),
              'd_fee' => $this->input->post('comimp_fee'),
              'd_tradeType' => 1,
            );
            /// IDENTIFICAR PARA HACER UN EDIT O UN ADD/////
            $id_tradeproductsrecn = -1;
            if ($this->input->post('edit') === '0')
                $id_tradeproductsrecn = $this->M_tradeproducts->set_tradeproducts($datostradeproducts);
            else if ($this->input->post('edit') === '1') {
                $id_tradeproductsrecn = $this->M_tradeproducts->update_tradeproducts($datostradeproducts);
            }
            //$id_tradeproductsrecn = 1;
            if ($id_tradeproductsrecn > 0) {
                $estado = array("state" => "Your licence has been successfully stored into the database.", 'success' => TRUE, 'recn' => $id_tradeproductsrecn);
            }
            else {
                $estado = array("state" => "The licence you had insert may not be saved.", 'success' => FALSE);
            }
            print_r(json_encode($estado));
        }

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /* ELIMINAR UN TRADEPRODUCT */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function tradeproducts_delete() {

        $id_comimp = $this->input->post('comimp_recn');

        $id_tradeproductsrecn = $this->M_tradeproducts->del_tradeproducts($id_comimp);

        if ($id_tradeproductsrecn > 0) {
            print_r(json_encode(array("state" => 'Your licence has been successfully deleted from the database.', 'success' => TRUE)));
        }
        else {
            print_r(json_encode(array('state' => 'Your licence was not deleted from the database.', 'success' => FALSE)));
        }

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    /* MOSTRAR TODA DATA OF tradeproducts */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Agregar tradeliveanimaldetails ///////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function add_tradeproductsdetails() {
        $data['d_recntp'] = $this->input->post('recntp');
        $data['d_recntpd'] = $this->input->post('recntpd');
        $data['d_sele_comimp_contry'] = $this->input->post('sele_comimp_contry');
        $data['d_comimp_date_comm'] = $this->input->post('comimp_date_comm');
        $data['d_sele_comimp_comm'] = $this->input->post('sele_comimp_comm');
        $data['d_weight_comimp'] = $this->input->post('weight_comimp');
        $data['d_Consignee_of_sender'] = NULL;
        $data['d_Consignee_of_receiver'] = NULL;
        $res = false;
        if ($this->input->post('edit') == 0) {
            $res = $this->M_tradeproductsdetails->set_tradeproductsdetails($data);
        }
        else {
            $res = $this->M_tradeproductsdetails->update_tradeproductsdetails($data);
        }

        print_r(json_encode($res));

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Editar tradeproductsdetails ///////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function edit_tradeproductsdetails() {
        $id = $this->input->post('recnlive');
        $res = $this->M_tradeproductsdetails->get_a_tradeproductsdetails($id);
        print_r(json_encode($res));

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Borrar tradeproductsdetails ///////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function delete_tradeproductsdetails() {
        $id = $this->input->post('recnlive');
        $res = $this->M_tradeproductsdetails->del_tradeproductsdetails($id);
        $r = array(
          'message' => 'The trade products details has been successfully deleted from the database.',
          'resp' => $res,
        );
        print_r(json_encode($r));

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Listar tradeproductsdetails ///////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function listar_tradeproductsdetails() {
        $id_tradeproducts = $this->input->post('recn');
        $tradeproducts = $this->M_tradeproductsdetails->get_tradeproductsdetails_by_tradeproducts($id_tradeproducts);

        print_r(json_encode($tradeproducts));

    }

    function get_tradeproducts_data($tradeproducts) {
        $registers_tradeproducts = $tradeproducts;
        $regiter_tradeproductsdetails = (count($registers_tradeproducts) > 0) ? $this->M_tradeproductsdetails->get_tradeproductsdetails_by_tradeproducts($registers_tradeproducts[0]['recn']) : array();

        $result = array('tradeproducts' => $registers_tradeproducts, 'tradeproductsdetails' => $regiter_tradeproductsdetails);


        return $result;

    }

    function search() {
        $name = $this->input->post('name');
        $datostradeproducts = array(
          'd_licenceNo' => $name,
          'd_fee' => $name,
          'd_tradeType' => 1,
        );

        $registers_tradeproducts = $this->M_tradeproducts->find_tradeproducts($datostradeproducts);
        $tradeproducts_and_details = $this->get_tradeproducts_data($registers_tradeproducts);

        print_r(json_encode($tradeproducts_and_details));

    }

    function licence_get_by_id() {
        $LicRecn = $this->input->post('LicRecn');


        $registers_tradeproducts = $this->M_tradeproducts->get_a_tradeproducts($LicRecn);
        $tradeproducts_and_details = $this->get_tradeproducts_data($registers_tradeproducts);

        print_r(json_encode($tradeproducts_and_details));

    }

}

//No borrar Llave de la clase 