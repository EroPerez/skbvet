<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('autenticado')) {
            redirect(site_url('Init'));
        }

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers'));
    }

    function index() {
        $data['title'] = 'Transfer Sale';
        $data['contry'] = $this->M_tblcountries->get_all_Countries();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['farm'] = $this->M_farms->get_farms();
        $this->data_template['accesos'] = $this->session->userdata('conf_acc');
        $this->data_template['script'] = $this->load->view('pages/s_transfer', NULL, TRUE);
        $this->render('pages/transfer_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    function livestock_by_farm() {
        $idfarm = $this->input->post('recn');
        $res = $this->M_livestock->get_a_Livestock_by_farm($idfarm);
        print_r(json_encode($res));
    }

}
