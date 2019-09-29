<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL, $access_level = array();

    function __construct() {
        parent::__construct();

        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->library('Form_builder');
        $this->load->library('System_message');
        $this->load->library('Email_client');
        $this->load->library('Session');

//        $this->load->database();
//        $this->load->model(array('M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers'));
         $this->load->model(array('M_tbldistricts'));
        $header['first'] = 'Usuarios';
        $header['page_title'] = 'Animalhealthrecords';
        $this->header_view = $this->load->view('templates/header', $header, TRUE);
        $this->footer_view = $this->load->view('templates/footer', '', TRUE);

//    if ($rol = $this->session->userdata('rol') !== NULL) {
//      $access = $this->M_access->get_acceso_by_level($rol);
//      foreach ($access as $key => $valor) {
//        $this->access_level[$key] = $this->leer_access($valor['configuration']);
//      }
//      $this->session->set_userdata($this->access_level);
//    }

    }

    // funcion de Incio.
    function index() {
//    $this->load->view('auth/login', NULL, FALSE);
        $data = array();

        if ($_POST) {
            $data = $this->auth->login($_POST);
        }

        return $this->auth->showLoginForm($data);

    }

    /**
     * Logout.
     */
    public function logout() {
        if ($this->auth->logout())
            return redirect('login');

        return false;

    }

    function pages($page) {

        switch ($page) {
            case 'dashboard':

                redirect('dashboard');
                break;
            case 'farm':

                $data['cont'] = 'Farm';
                redirect('farm');
                break;
            case 'illness':

                redirect('illness');
                break;
            case 'comimp':

                redirect('comimp');
                break;
            case 'comexp':

                redirect('comexp');
                break;
            case 'animalimp':

                redirect('animalimp');
                break;
            case 'animalexp':

                redirect('animalexp');
                break;
            case 'transfer':

                redirect('transfer');
                break;
            case 'setup':

                redirect('setup');
                break;
//            case 'abbatoir':
//
//                redirect('abbatoir');
//                break;
            case 'specimen':

                redirect('specimen');
                break;
            case 'surveillance':

                redirect('surveillance');
                break;
            case 'any':

                redirect('any');
                break;
            default:
                $data['parish'] = $this->M_tbldistricts->get_all_Districts();
                $data['crum'] = '';
                $this->render('pages/any_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
                break;
        }

    }

}
