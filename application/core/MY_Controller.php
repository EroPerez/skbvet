<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    protected $data = array();
    protected $login = true; //True si el sitio necesita authentication
    protected $login_back_end = FALSE; //True si el sitio contiene un backend 
    protected $login_in = FALSE;
    protected $result_f_access = array();
    protected $accesos = array(
      'allow_intro_edit' => array(
        'farm_farmers' => '0',
        'livestock' => '0',
        'transfer' => '0',
        'case' => '0',
        'treatment' => '0',
        'bills' => '0',
        'presenters' => '0',
        'comm_licence' => '0',
        'livestock_licence' => '0'
      ),
      'allow_user_setup' => array(
        'species' => '0',
        'breeds' => '0',
        'districts' => '0',
        'veterinarian' => '0',
        'illness' => '0',
        'treatments' => '0',
        'commodities' => '0',
        'contries' => '0',
        'traders' => '0',
        'owners' => '0'
      ),
      'allow_user_view' => array(
        'all_farm_lives_rep' => '0',
        'all_case_rep' => '0',
        'all_abbatair_reports' => '0',
        'all_licence_reports' => '0'
      ),
      'maintenance' => array(
        'add_user' => '0',
        'delete_user' => '0',
        'setup_passwd' => '0'
      )
    );

    function __construct() {
        parent::__construct();
        $this->load->library('Session');
        $this->data_template['page_title'] = 'AnimalHealthRecords';
        $this->load->library('table');
        $this->load->library('Auth', array(), 'auth');

        $this->load->database();
//        $this->load->model(array('M_access'));

        $this->data_template['js_files'] = array();
        $this->data_template['css_files'] = array();



        ///$this->leer_access($access['configuration']);

    }

    protected function leer_access($accss) {

        $arreglo_var = str_split($accss);
        $allow_intro_edit = array_slice($arreglo_var, 0, 9);
        $allow_user_setup = array_slice($arreglo_var, 9, 10);
        $allow_user_view = array_slice($arreglo_var, 19, 4);

        $maintenance = array_slice($arreglo_var, 23, 3);

        $this->accesos['allow_intro_edit']['farm_farmers'] = $allow_intro_edit['0'];
        $this->accesos['allow_intro_edit']['livestock'] = $allow_intro_edit['1'];
        $this->accesos['allow_intro_edit']['transfer'] = $allow_intro_edit['2'];
        $this->accesos['allow_intro_edit']['case'] = $allow_intro_edit['3'];
        $this->accesos['allow_intro_edit']['treatment'] = $allow_intro_edit['4'];
        $this->accesos['allow_intro_edit']['bills'] = $allow_intro_edit['5'];
        $this->accesos['allow_intro_edit']['presenters'] = $allow_intro_edit['6'];
        $this->accesos['allow_intro_edit']['comm_licence'] = $allow_intro_edit['7'];
        $this->accesos['allow_intro_edit']['livestock_licence'] = $allow_intro_edit['8'];

        $this->accesos['allow_user_setup']['species'] = $allow_user_setup['0'];
        $this->accesos['allow_user_setup']['breeds'] = $allow_user_setup['1'];
        $this->accesos['allow_user_setup']['districts'] = $allow_user_setup['2'];
        $this->accesos['allow_user_setup']['veterinarian'] = $allow_user_setup['3'];
        $this->accesos['allow_user_setup']['illness'] = $allow_user_setup['4'];
        $this->accesos['allow_user_setup']['treatments'] = $allow_user_setup['5'];
        $this->accesos['allow_user_setup']['commodities'] = $allow_user_setup['6'];
        $this->accesos['allow_user_setup']['contries'] = $allow_user_setup['7'];
        $this->accesos['allow_user_setup']['traders'] = $allow_user_setup['8'];
        $this->accesos['allow_user_setup']['owners'] = $allow_user_setup['9'];

        $this->accesos['allow_user_view']['all_farm_lives_rep'] = $allow_user_view['0'];
        $this->accesos['allow_user_view']['all_case_rep'] = $allow_user_view['1'];
        $this->accesos['allow_user_view']['all_abbatair_reports'] = $allow_user_view['2'];
        $this->accesos['allow_user_view']['all_licence_reports'] = $allow_user_view['3'];

        $this->accesos['maintenance']['add_user'] = $maintenance['0'];
        $this->accesos['maintenance']['delete_user'] = $maintenance['1'];
        $this->accesos['maintenance']['setup_passwd'] = $maintenance['2'];

        return $this->accesos;

    }

    /////////////////////////////////////////////
    /////FUNCION PARA MOSTRAR LA VISTA:
    ///// PRIMER PARAMETRO : LA VISTA CONTENIDO
    ///// SEGUNDO PARAMETRO: EL TEMPLATE DE LA VISTA
    ///// TRECER PARAMETRO: VARIABLES DEL HEADER
    ///// CUARTO PARAMETRO: VARIABLE DEL CONTENIDO DE LA VISTA PRINCIPAL
    ///// QUINTO PARAMETRO: VARIABLE DEL FOOTER 
    //protected function render($the_view = NULL, $template = 'template_any', $data_header=array(), $data_count=array(), $data_footer=array())
    protected function render($the_view = NULL, $template = 'template_any_view', $data_template = NULL, $data_header = '', $data_count = array(), $data_footer = '') {

        // $this->data['header_view'] =$this->load->view('templates/header',$data_header, TRUE);
        // $this->data['footer_view'] =$this->load->view('templates/footer',$data_footer, TRUE);
        $this->data['header_view'] = $data_header;
        $this->data['footer_view'] = $data_footer;

        $this->data['jsscript'] = $data_template;
        $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $data_count, TRUE);

        $this->load->view('templates/' . $template . '_view', $this->data);

    }

    protected function auth_val($rol, $acl = '', $acc_name = '') {


        $autenticado = $this->session->userdata('autenticado');
        $rol_level = $this->session->userdata('rol');

        if ($rol == $rol_level) {
            if ($autenticado) {
                if ($rol_level == "1") {

                    return true;
                }
                elseif ($rol_level == "2") {

                    return true;
                }
                elseif ($rol_level == "3") {

                    return true;
                }
                elseif ($rol_level == "4") {

                    return true;
                }
                elseif ($rol_level == "5") {

                    return true;
                }
                else {
                    if ($rol_level == $rol) {
                        return true;
                    }
                    else {
                        show_error('Acces Prohibido!!!', 403);
                    }
                }
            }
        }
        else {
            return false;
        }

    }

    //END FUNCTION//
}

// LLAVE DE LA CLASE

class Admin_Controller extends MY_Controller {

    ///CONSTRUCTOR//
    function __construct() {
        parent::__construct();

    }

    //END CONSTRUCTOR//
}

class Clientes_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();

    }

}
