<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends My_Controller {

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
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_tblcommodities', 'M_specimenpermit', 'M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_tbltraders', 'M_tradeliveanimals', 'M_tradeliveanimalsdetails', 'M_tradeproducts', 'M_surveillance', 'M_caseillnesses', 'M_tradeliveanimals', 'M_casedetails'));

        //new authentication method
        $this->auth->route_access();

    }

    function rpt_import_licences() {

        $animalimp_commodities = $this->input->post('animalimp_commodities');
        $time_filter = $this->input->post('time_filter');
        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');

        $data['animalimp_commodities'] = $animalimp_commodities;
        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;


        $data['title'] = 'Meats Import Licences Report';
        $data['pag'] = 'report';
        $data['commodities'] = $this->M_tblcommodities->get_all_Commodities();
        //$data['import_licences'] = $this->M_tradeproducts->get_quarter_import_licences('2009-03-01', animalimp_commodities);
        if ($time_filter == 0 && $date != '')
            $data['import_licences'] = $this->M_tradeproducts->get_quarter_import_licences($date, $animalimp_commodities);
        else
            $data['import_licences'] = $this->M_tradeproducts->get_yearly_import_licences($year_filter, $animalimp_commodities);

        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/import_licences_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_animal_illness_cases() {

        $time_filter = $this->input->post('time_filter');

        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');
        $splitDate = explode('-', $date);
        $data['animal_illness_cases'] = array('rows' => array(), 'total number of cases' => 0);
        if ($time_filter == 0 && $date != '') {
            $data['animal_illness_cases'] = $this->M_casedetails->get_quarterly_animal_illness_cases($date);
        }
        if ($time_filter == -1 && $date != '') {
            $data['animal_illness_cases'] = $this->M_casedetails->get_monthly_animal_illness_cases($splitDate[1], $splitDate[0]);
        }
        if ($time_filter == 1) {
            $data['animal_illness_cases'] = $this->M_casedetails->get_yearly_animal_illness_cases($year_filter);
        }

        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;

        $data['title'] = 'Animals Illness Cases Report';
        $data['pag'] = 'report';
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/animal_illness_cases_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_animal_imported() {
        $animalimp_species = $this->input->post('animalimp_species');
        $time_filter = $this->input->post('time_filter');
        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');

        $data['animalimp_species'] = $animalimp_species;
        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;
        $data['import_imported'] = array();
        if ($time_filter == 0 && $date != '')
            $data['import_imported'] = $this->M_tradeliveanimals->get_quarterly_number_of_animal_imported_by_species($date, $animalimp_species);
        if ($time_filter == 1)
            $data['import_imported'] = $this->M_tradeliveanimals->get_yearly_number_of_animal_imported_by_species($year_filter, $animalimp_species);

        $data['title'] = 'Animals Import Licences Report';
        $data['pag'] = 'report';
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/animal_imported_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_withdrawal_period() {

        $data['title'] = 'Withdrawal Period Report';
        $data['pag'] = 'report';
        $data['withdrawal_period'] = $this->M_caseillnesses->get_animal_in_withdrawal_period();
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/withdrawal_period_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_number_of_biological() {
        $data['title'] = 'Number of Biological Specimen Permit Issued Report';
        $data['pag'] = 'report';

        $time_filter = $this->input->post('time_filter');
        $date = $this->input->post('specimen_date');
        $year_filter = $this->input->post('year_filter');

        $data['total'] = array('Number of Biological Specimen' => 0);

        if ($time_filter == 0 && $date != '')
            $data['total'] = $this->M_specimenpermit->get_quarterly_number_of_specimenpermit($date);

        if ($time_filter == 1)
            $data['total'] = $this->M_specimenpermit->get_yearly_number_of_specimenpermit($year_filter);

        $data['time_filter'] = $time_filter;
        $data['specimen_date'] = $date;
        $data['year_filter'] = $year_filter;
        $this->data_template['script'] = $this->load->view('pages/s_specimen', NULL, TRUE);
        $this->render('report/number_of_biological_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_export_animals() {
        $data['title'] = 'Animals Export Licences Report';
        $data['pag'] = 'report';
        $time_filter = $this->input->post('time_filter');

        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');


        $data['animals'] = array();
        if ($time_filter == 0 && $date != '') {
            $data['animals'] = $this->M_tradeliveanimals->get_quarter_liveanimals_export_licences($date);
        }
        if ($time_filter == 1) {
            $data['animals'] = $this->M_tradeliveanimals->get_yearly_liveanimals_export_licences($year_filter);
        }

        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/export_animals_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_export_meats() {
        $data['title'] = 'Meats Export Licences Report';
        $data['pag'] = 'report';

        $time_filter = $this->input->post('time_filter');

        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');


        $data['animals'] = array();
        if ($time_filter == 0 && $date != '')
            $data['animals'] = $this->M_tradeproducts->get_quarter_export_licences($date);
        if ($time_filter == 1)
            $data['animals'] = $this->M_tradeproducts->get_yearly_export_licences($year_filter);

        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);
        $this->render('report/export_meats_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function rpt_surveillance() {
        $time_filter = $this->input->post('time_filter');

        $date = $this->input->post('comimp_date');
        $year_filter = $this->input->post('year_filter');

        $data['surveillances'] = array('rows' => array(), 'total number of animal tested' => 0);
        if ($time_filter == 0 && $date != '')
            $data['surveillances'] = $this->M_surveillance->get_quarterly_surveillancedata($date);
        if ($time_filter == 1)
            $data['surveillances'] = $this->M_surveillance->get_yearly_surveillancedata($year_filter);

        $data['time_filter'] = $time_filter;
        $data['comimp_date'] = $date;
        $data['year_filter'] = $year_filter;

        $data['title'] = 'Surveillance Data Report';
        $data['pag'] = 'report';
        $this->data_template['script'] = $this->load->view('pages/s_report', NULL, TRUE);

        $this->render('report/surveillance_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

}
