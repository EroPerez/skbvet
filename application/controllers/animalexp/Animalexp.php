<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Animalexp extends My_Controller {

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
        $this->load->model(array('M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_tbltraders', 'M_tradeliveanimals', 'M_tradeliveanimalsdetails'));
        
                
        //new authentication method
        $this->auth->route_access();
    }

    function index($action, $recn = NULL) {
        $data['title'] = 'Live Animals Licence (Exp)';
        $data['pag'] = 'animexp';
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['country'] = $this->M_tblcountries->get_all_Countries();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['breed'] = $this->M_tblbreeds->get_all_Breeds();
        $data['trader'] = $this->M_tbltraders->get_Traders_by_type(2);
        $data['unit_time'] = $this->M_tblunits->get_units_by_type(2);
        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_animalexp', $operation, TRUE);
        $this->render('pages/animalexp_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function Animalexp_list() {

        $data = array();
        try {
            $data['title'] = 'Live Animals Licences (Exp) List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();
            $crud->where('tradeType', 2);

            $crud->set_theme('datatables');
            $crud->set_table('tbltradeliveanimals');
            $crud->set_subject('Licence (Exp)');
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
            $this->data_template['script'] = $this->load->view('pages/s_animalexp', array('action' => '', 'recn' => ''), TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function crud_edit_action($primary_key, $row) {
        return site_url('animalexp/licence/edit') . '/' . $primary_key;
    }

    function crud_view_action($primary_key, $row) {
        return site_url('animalexp/licence/read') . '/' . $primary_key;
    }

    function delete_callback($primary_key) {
        $this->M_tradeliveanimalsdetails->del_tradeliveanimalsdetails_by($primary_key);
        return $this->M_tradeliveanimals->del_tradeliveanimals($primary_key);
    }

    function dateOfLicence_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');
    }

    function fee_callback($value, $row) {

        return '$' . \round($value * 100) / 100;
    }

    function tradeType_callback($value, $row) {
        return 'Exp';
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    /* Navegar backwards por la base */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function tradeliveanimal_backward() {
//        $idtradeliveanimal = $this->input->post('recn') - 1;
//        $a = 2;
//        $all_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_impexp($a);
//        $ult_reg = end($all_tradeliveanimal);
//        $first_reg = reset($all_tradeliveanimal);
//
//        if ($idtradeliveanimal < 0 || $idtradeliveanimal < $first_reg['recn']) {
//            $idtradeliveanimal = $ult_reg['recn'];
//            $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//        } else {
//
//            $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//
//            while ($registers_tradeliveanimal === array()) {
//
//                $idtradeliveanimal = $idtradeliveanimal - 1;
//                $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//            }
//        }
//
//        print_r(json_encode($this->get_tradeliveanimal_data($registers_tradeliveanimal)));

        $page = $this->input->post('page');
        $a = 2;
        $all_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_impexp($a);

        if ($page - 1 <= 0 || $page > count($all_tradeliveanimal)) {

            $page = count($all_tradeliveanimal);
        } else {
            $page = $page - 1;
        }


        $registers_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_pagination($page - 1, $a);
        $tradeliveanimal_and_details = $this->get_tradeliveanimal_data($registers_tradeliveanimal);


        $tradeliveanimal_and_details['page'] = $page;
        print_r(json_encode($tradeliveanimal_and_details));
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function tradeliveanimal_forward() {
//        $idtradeliveanimal = $this->input->post('recn') + 1;
//        $a = 2;
//        $all_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_impexp($a);
//        $ult_reg = end($all_tradeliveanimal);
//        $first_reg = reset($all_tradeliveanimal);
//
//        if ($idtradeliveanimal > $ult_reg['recn']) {
//            $idtradeliveanimal = $first_reg['recn'];
//            $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//        } else {
//
//            $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//
//            while ($registers_tradeliveanimal === array()) {
//
//                $idtradeliveanimal = $idtradeliveanimal + 1;
//                $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($idtradeliveanimal);
//            }
//        }
        $page = $this->input->post('page');
        $a = 2;
        $all_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_impexp($a);

        if ($page + 1 > count($all_tradeliveanimal) || $page <= 0) {
            $page = 1;
        } else {
            $page = $page + 1;
        }
        $registers_tradeliveanimal = $this->M_tradeliveanimals->get_tradeliveanimals_pagination($page - 1, $a);
        $tradeliveanimal_and_details = $this->get_tradeliveanimal_data($registers_tradeliveanimal);


        $tradeliveanimal_and_details['page'] = $page;
        print_r(json_encode($tradeliveanimal_and_details));
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /* ADICIONAR UN LIVEANIMAL */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

    function tradeliveanimal_add_edit() {
        $datos = array();
        $this->form_validation->set_rules('animalimp_licenceNo', 'animalimp_licenceNo', 'required');
        $this->form_validation->set_rules('animalimp_date', 'animalimp_date', 'required');
        $this->form_validation->set_rules('animalimp_importer', 'animalimp_importer', 'required');
        $this->form_validation->set_rules('animalimp_fee', 'animalimp_fee', 'required');

        if ($this->form_validation->run() == FALSE) {
            $estado = array("state" => "All data are required", 'success' => FALSE);
            print_r(json_encode($estado));
        } else {
            date('F j, Y \a\t g:i A', strtotime($this->input->post('animalimp_date')));

            $datostradeliveanimal = array(
                'd_recn' => $this->input->post('animalimp_recn'),
                'd_dateOfLicence' => date('Y-m-d', strtotime($this->input->post('animalimp_date'))),
                'd_licenceNo' => $this->input->post('animalimp_licenceNo'),
                'd_FarmRecn' => $this->input->post('animalimp_importer'),
                'd_fee' => $this->input->post('animalimp_fee'),
                'd_tradeType' => 2,
            );
            /// IDENTIFICAR PARA HACER UN EDIT O UN ADD/////
            $id_tradeliveanimalrecn = -1;
            $estado = array();
            if ($this->input->post('edit') === '0')
                $id_tradeliveanimalrecn = $this->M_tradeliveanimals->set_tradeliveanimals($datostradeliveanimal);
            else if ($this->input->post('edit') === '1') {
                $id_tradeliveanimalrecn = $this->M_tradeliveanimals->update_tradeliveanimals($datostradeliveanimal);
            }

            if ($id_tradeliveanimalrecn > 0) {
                $estado = array("status" => TRUE, "state" => "Your data has been successfully stored into the database.", 'success' => TRUE, 'id' => $id_tradeliveanimalrecn);               
            } else {
                $estado = array("status" => FALSE, "state" => "The data you had insert may not be saved.", 'success' => FALSE, 'id' => $id_tradeliveanimalrecn);
            }
            print_r(json_encode($estado));
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /* ELIMINAR UNA ANIMAL IMPORTER LICENCE */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function tradeliveanimal_delete() {

        $id_animalimp = $this->input->post('animalimp_recn');
        $recn_trade_live_animal_delete = $this->M_tradeliveanimals->del_tradeliveanimals($id_animalimp);

        if ($recn_trade_live_animal_delete > 0) {
            print_r(json_encode(array("state" => 'Your data has been successfully deleted from the database.', 'success' => TRUE)));
        } else {
            print_r(json_encode(array("state" => 'Your data has not been deleted from the database.', 'success' => FALSE)));
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    /* MOSTRAR TODA DATA OF tradeliveanimal */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Agregar tradeliveanimaldetails ///////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function add_tradeliveanimaldetails() {
        $data['d_recntp'] = $this->input->post('recntp');
        $data['d_recntpd'] = $this->input->post('recntpd');
        $data['d_animalimp_origin'] = $this->input->post('animalimp_origin');
        $data['d_animalimp_dateadd'] = $this->input->post('animalimp_dateadd');
        $data['d_animalimp_status'] = $this->input->post('animalimp_status');
        $data['d_animalimp_species'] = $this->input->post('animalimp_species');
        $data['d_animalimp_breeds'] = $this->input->post('animalimp_breeds');
        $data['d_animalimp_quantity'] = $this->input->post('animalimp_quantity');
        $data['d_animalimp_quara_period'] = $this->input->post('animalimp_quara_period');
        $data['d_animalimp_quarantine_unit'] = $this->input->post('animalimp_quarantine_unit');
        $data['d_animalimp_comment'] = $this->input->post('animalimp_comment');

        $data['d_Consignee_of_sender'] = $this->input->post('animalimp_sender');
        $data['d_Consignee_of_receiver'] = $this->input->post('animalimp_receiver');

        $datos = array();
        $this->form_validation->set_rules('animalimp_species', 'animalimp_species', 'required');
        $this->form_validation->set_rules('animalimp_breeds', 'animalimp_breeds', 'required');

        if ($this->form_validation->run() == FALSE) {
            $estado = array("state" => "All data are required", 'success' => FALSE);
            print_r(json_encode($estado));
        } else {
            //$recn_trade_live_animal_add = 0;
            if ($this->input->post('edit') == 0) {
                $result = $this->M_tradeliveanimalsdetails->set_tradeliveanimalsdetails($data);
            } else {
                $result = $this->M_tradeliveanimalsdetails->update_tradeliveanimalsdetails($data);
            }
            if ($result > 0) {
                $estado = array("state" => "Your data has been successfully stored into the database.", 'success' => TRUE);
            } else {
                $estado = array("state" => "Your data has not been stored into the database.", 'success' => FALSE);
            }
            print_r(json_encode($estado));
            //$res = $this->listar_tradeliveanimaldetails();
            //return $res;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Editar tradeliveanimaldetails ///////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function edit_tradeliveanimaldetails() {
        $id = $this->input->post('recnlive');
        $res = $this->M_tradeliveanimalsdetails->get_a_tradeliveanimalsdetails($id);

        print_r(json_encode($res));
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Borrar tradeliveanimaldetails ///////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function delete_tradeliveanimaldetails() {
        $id = $this->input->post('recnlive');
        $recn_trade_live_animal_delete = $this->M_tradeliveanimalsdetails->del_tradeliveanimalsdetails($id);

        if ($recn_trade_live_animal_delete > 0) {
            print_r(json_encode(array("state" => 'Your data has been successfully deleted from the database.', 'success' => TRUE)));
        } else {
            print_r(json_encode(array("state" => 'Your data has not been deleted from the database.', 'success' => FALSE)));
        }

        return;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///// Listar tradeliveanimaldetails ///////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function listar_tradeliveanimaldetails() {
        $id_tradeliveanimal = $this->input->post('recn');
        $tradeliveanimal = $this->M_tradeliveanimalsdetails->get_tradeliveanimalsdetails_by_tradeliveanimals($id_tradeliveanimal);

        print_r(json_encode($tradeliveanimal));
    }

    function get_tradeliveanimal_data($tradeliveanimal) {
        $registers_tradeliveanimal = $tradeliveanimal;
        $regiter_tradeliveanimaldetails = $this->M_tradeliveanimalsdetails->get_tradeliveanimalsdetails_by_tradeliveanimals($registers_tradeliveanimal[0]['recn']);

        $result = array('tradeliveanimal' => $registers_tradeliveanimal, 'tradeliveanimaldetails' => $regiter_tradeliveanimaldetails);

        return $result;
    }

////////////////////////////////////////////////////////////////
///// llenar el option breeds en animal segun species ///////

    function breeds_species() {
        $recn = $this->input->post('recn');
        $result = $this->M_tblbreeds->get_breeds_by_species($recn);
        foreach ($result as $key_breeds => $value) {
            echo '<option value="' . $value["recn"] . '">' . $value["name"] . '</option>';
        }
//  print_r(json_encode($result));
    }

    function search() {
        $name = $this->input->post('name');
        $datostradeliveanimal = array(
            'd_licenceNo' => $name,
            'd_fee' => $name,
            'd_tradeType' => 2,
        );

        $registers_tradeliveanimal = $this->M_tradeliveanimals->find_tradeliveanimals($datostradeliveanimal);
        $tradeliveanimal_and_details = $this->get_tradeliveanimal_data($registers_tradeliveanimal);

        print_r(json_encode($tradeliveanimal_and_details));
    }

    function licence_get_by_id() {
        $LicRecn = $this->input->post('LicRecn');


        $registers_tradeliveanimal = $this->M_tradeliveanimals->get_a_tradeliveanimals($LicRecn);
        $tradeliveanimal_and_details = $this->get_tradeliveanimal_data($registers_tradeliveanimal);

        print_r(json_encode($tradeliveanimal_and_details));
    }

}

//No borrar llave de la clase