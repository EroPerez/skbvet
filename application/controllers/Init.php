<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL, $access_level = array();

    function __construct() {
        parent::__construct();

        $this->load->library('Form_validation');
        $this->load->library('Form_builder');
        $this->load->library('System_message');
        $this->load->library('Email_client');
        $this->load->library('Session');
        $this->load->database();
        $this->load->library(array('auth', 'form_validation'));

        $header['first'] = 'Users';
        $header['page_title'] = 'Animalhealthrecords';
        $this->header_view = $this->load->view('templates/header', $header, TRUE);
        $this->footer_view = $this->load->view('templates/footer', '', TRUE);

    }

    // funcion de Incio.
    function index() {
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
            return redirect('auth/login');

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
            case 'permissions':

                redirect('permissions');
                break;
            case 'users':

                redirect('users');
                break;
            default:
                show_404();
                break;
        }

    }

}
