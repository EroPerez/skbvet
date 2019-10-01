<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {

        parent::__construct();

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_surveillance', 'M_surveillancedetails'));

        //new authentication method
        $this->auth->route_access();

    }

    function index($action, $recn = NULL) {
        $data['title'] = 'Transfer Sale';
        $data['contry'] = $this->M_tblcountries->get_all_Countries();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['farm'] = $this->M_farms->get_farms();
        $data['pag'] = 'transfer';
//        $this->data_template['accesos'] = $this->session->userdata('conf_acc');
        $operation = array('action' => $action, 'recn' => $recn);
        $this->data_template['script'] = $this->load->view('pages/s_transfer', $operation, TRUE);
        $this->render('pages/transfer_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function transfer_list() {

        $data = array();
        try {
            $data['title'] = 'Transfer Sale List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();

            $crud->set_theme('datatables')
              ->set_table('tbltransfers')
              ->set_subject('Transfer')
              ->unset_clone()
              ->unset_edit()
              ->unset_read()
              ->unset_print()
              ->unset_delete()
              ->unset_jquery()
              ->set_relation('FromFarmRecn', 'tblfarms', 'farmName')
              ->set_relation('ToFarmRecn', 'tblfarms', 'farmName')
              ->set_relation('LivestockRecn', 'tbllivestock', 'IDNO')
              ->display_as('LivestockRecn', 'Livestock ID')
              ->display_as('FromFarmRecn', 'From Farm')
              ->display_as('ToFarmRecn', 'To Farm')
              ->display_as('TransferDate', 'Transfer Date')
              ->callback_column('TransferDate', array($this, 'TransferDate_callback'))
              ->order_by('recn', 'desc');


            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_transfer_list', NULL, TRUE);

            $this->render('pages/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function TransferDate_callback($value, $row) {
        $dt = new DateTime($value);
        return $dt->format('d/M/Y');

    }

    function livestock_by_farm() {
        $idfarm = $this->input->post('recn');
        $res = $this->M_livestock->get_a_Livestock_by_farm($idfarm);
        print_r(json_encode($res));

    }

    function save_transf() {
        $livestockRecns = $this->input->post('livestock[]');
        $fromFarm = $this->input->post('recn_f_from');
        $toFarm = $this->input->post('recn_f_to');
        $transferDate = $this->input->post('date_transf');

//        print_r($livestockRecns);

        if (empty($livestockRecns) || empty($fromFarm) || empty($toFarm) || empty($transferDate)) {
            $estado = array("state" => "All data are required to successfully complete a Tranfer Sale.", 'success' => FALSE);
            print_r(json_encode($estado));
        }
        else {
            foreach ($livestockRecns as $livestockRecn) {
                $tranfer_data = array();
                $tranfer_data['d_LivestockRecn'] = $livestockRecn;
                $tranfer_data['d_FromFarmRecn'] = $fromFarm;
                $tranfer_data['d_ToFarmRecn'] = $toFarm;
                $tranfer_data['d_TransferDate'] = $transferDate;
                $res = $this->M_transfers->set_transfers($tranfer_data);
                $result_live = $this->M_livestock->get_a_Livestock($livestockRecn);

                //Update animal owner
                $livestock_data = array();
                $livestock_data['d_recn'] = $livestockRecn;
                $livestock_data['d_IDNO'] = $result_live[0]['IDNO'];
                $livestock_data['d_breedRecn'] = $result_live[0]['breedRecn'];
                $livestock_data['d_sex'] = $result_live[0]['sex'];
                $livestock_data['d_dateOfBirth'] = $result_live[0]['dateOfBirth'];
                $livestock_data['d_localOrOverseas'] = $result_live[0]['localOrOverseas'];
                $livestock_data['d_arrivalDate'] = $result_live[0]['arrivalDate'];
                $livestock_data['d_quarantinePeriod'] = $result_live[0]['quarantinePeriod'];
                $livestock_data['d_quarantinePeriodUnits'] = $result_live[0]['quarantinePeriodUnits'];
                $livestock_data['d_countryOfOrigin'] = $result_live[0]['countryOfOrigin'];
                $livestock_data['d_farmRecn'] = $toFarm;
                $livestock_data['d_dateAdded'] = $result_live[0]['dateAdded'];
                $this->M_livestock->update_Livestock($livestock_data);

                //Transfer surveilance of this animals to new owner
                $surveillancedetails = $this->M_surveillancedetails->get_a_surveillancedetails_by($fromFarm, $livestockRecn);
                if (!empty($surveillancedetails)) {
                    foreach ($surveillancedetails as $survdetail) {

                        $surv = $this->M_surveillance->get_a_surveillance($survdetail['surveillanceRecn']);
                        $surv_data = array(
                          'farmRecn' => $toFarm,
                          'testRecn' => $surv[0]['testRecn'],
                          'dateOfSurveillance' => $surv[0]['dateOfSurveillance'],
                          'recn' => $surv[0]['recn']
                        );
                        $this->M_surveillance->update_surveillance($surv_data);
                    }
                }
            }
            print_r(json_encode(array('state' => 'Your Transfer has been successfully saved.', 'success' => TRUE)));
        }

    }

}

// fin de la class