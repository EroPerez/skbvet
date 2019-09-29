<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setup extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL;

    function __construct() {

        parent::__construct();
        /* if(!$this->login_in ){
          redirect(site_url('Init'));
          } */

        if (!$this->session->userdata('autenticado')) {
            redirect(site_url('Init'));
        }

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts',
            'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_tblcommodities',
            'M_tblillnessnames', 'M_tblowners', 'M_tbltraders', 'M_tbltreatmentnames', 'M_tblveterinarians',
            'M_tbltestnames'));
    }

    function index() {
        $data['title'] = 'Setup';
        $data['pag'] = 'setup';
        $data['commodity'] = $this->M_tblcommodities->get_all_Commodities();
        $data['contry'] = $this->M_tblcountries->get_all_Countries();
        //Agregado por Laura 20-03-2017
        $data['units'] = $this->M_tblunits->get_all_Units();
        $data['districts'] = $this->M_tbldistricts->get_all_Districts();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['breeds'] = $this->M_tblbreeds->get_all_Breeds();
        //$data['transfers'] =  $this->M_transfers->get_transfers();
        $data['illness'] = $this->M_tblillnessnames->get_all_illnessname();
        $data['owners'] = $this->M_tblowners->get_all_Owners();
        $data['traders'] = $this->M_tbltraders->get_all_Traders();
        $data['itraders'] = $this->M_tbltraders->get_Traders_by_type(1);
        $data['etraders'] = $this->M_tbltraders->get_Traders_by_type(2);
        $data['treatmentnames'] = $this->M_tbltreatmentnames->get_all_TreatmentNames();
        $data['veterinarians'] = $this->M_tblveterinarians->get_all_Veterinarians();
        $data['testnames'] = $this->M_tbltestnames->get_all_testnames();
        //Termina Agregado por Laura 23-03-2017
        $this->data_template['accesos'] = $this->session->userdata('conf_acc');
        $this->data_template['script'] = $this->load->view('pages/s_setup', TRUE, TRUE);
        $this->render('pages/setup_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    //////COMMODITY/////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    ///////SETUP ADD COMMODITY //////////////////////////////////////////////////////////////////////////////////////////
    function add_commodity() {
        $namecomm['d_name'] = $this->input->post('name');
        $result = $this->M_tblcommodities->set_Commodities($namecomm);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT COMMODITY ////////////////////////////////////////////////////////////////////////////////////////
    function edit_commodity() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblcommodities->update_Commodities($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP DELETE COMMODITY////////////////////////////////////////////////////////////////////////////////////////
    function delete_commodity() {
        $idcomm = $this->input->post('recnactivo');
        $result = $this->M_tblcommodities->del_Commodities($idcomm[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// COMMODITY LIST///////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_commodity() {
        $result = $this->M_tblcommodities->get_all_Commodities();
        foreach ($result as $key => $value) {
            echo '<option id="optcom_' . $value["recn"] . '" data-commod="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////COMMODITY END///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //COUNTRIES/////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP ADD Countries////////////////////////////////////////////////////////////////////////////////////
    function add_countries() {
        $data['d_name'] = $this->input->post('name');
        $data['d_type'] = $this->input->post('type');
        $result = $this->M_tblcountries->set_countries($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP EDIT Countries/////////////////////////////////////////////////////////////////////////////////
    function edit_countries() {
        $data['d_name'] = $this->input->post('name');
        $data['d_type'] = $this->input->post('type');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblcountries->update_countries($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP DELETE Countries/////////////////////////////////////////////////////////////////////////////////
    function delete_countries() {
        $idcountries = $this->input->post('recnactivo');
        $result = $this->M_tblcountries->del_countries($idcountries[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Countries//////////////////////////////////////////////////////////////////////////////
    function get_one_countries() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblcountries->get_one_countries($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////LIST Countries/////////////////////////////////////////////////////////////////////////////////////////
    function listar_countries() {
        $result = $this->M_tblcountries->get_all_countries();
        foreach ($result as $key => $value) {
            echo '<option id = "optcountries_' . $value["recn"] . '" data-countries="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //COUNTRIES END/////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ILLNESSNAMES//////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP ADD IllnessName////////////////////////////////////////////////////////////////////////////////////
    function add_illnessname() {
        $data['d_name'] = $this->input->post('name');
        $data['d_code'] = $this->input->post('code');
        $result = $this->M_tblillnessnames->set_illnessname($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP EDIT IllnessName/////////////////////////////////////////////////////////////////////////////////
    function edit_illnessname() {
        $data['d_name'] = $this->input->post('name');
        $data['d_code'] = $this->input->post('code');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblillnessnames->update_illnessname($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP DELETE IllnessName/////////////////////////////////////////////////////////////////////////////////
    function delete_illnessname() {
        $idillnessname = $this->input->post('recnactivo');
        $result = $this->M_tblillnessnames->del_illnessname($idillnessname[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE IllnessesNames//////////////////////////////////////////////////////////////////////////////
    function get_one_illnessname() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblillnessnames->get_one_illnessname($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////LIST IllnessName/////////////////////////////////////////////////////////////////////////////////////////
    function listar_illnessname() {
        $result = $this->M_tblillnessnames->get_all_illnessname();
        foreach ($result as $key => $value) {
            echo '<option id = "optillnessname_' . $value["recn"] . '" data-illnessname="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////END ILLNESSNAME//////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SPECIES-BREEDS///////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP ADD Species-Breeds ///////////////////////////////////////////////////////////////////////////////////////
    function add_species() {
        $data['d_name'] = $this->input->post('name');
        $result = $this->M_tblspecies->set_Species($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    function add_breeds() {
        $data['d_name'] = $this->input->post('name');
        $data['d_speciesrecn'] = $this->input->post('speciesrecn');
        $result = $this->M_tblbreeds->set_breeds($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Species-Breeds //////////////////////////////////////////////////////////////////////////////////////
    function edit_species() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblspecies->update_Species($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    function edit_breeds() {
        $data['d_name'] = $this->input->post('name');
        $data['d_speciesrecn'] = $this->input->post('speciesrecn');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblbreeds->update_breeds($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP DELETE Species-Breeds ////////////////////////////////////////////////////////////////////////////////////
    function delete_species() {
        $idspecies = $this->input->post('recnactivo');
        $result = $this->M_tblspecies->del_Species($idspecies[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    function delete_breeds() {
        $idspecies = $this->input->post('recnactivo');
        $result = $this->M_tblbreeds->del_breeds($idspecies[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Species-Breeds////////////////////////////////////////////////////////////////////////////////////
    function get_one_species() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblspecies->get_one_Species($recn);
        print_r(json_encode($result));
    }

    function get_one_breeds() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblbreeds->get_one_breeds($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// LIST Species-Breeds //////////////////////////////////////////////////////////////////////////////////////////
    function listar_species() {
        $result = $this->M_tblspecies->get_all_Species();
        foreach ($result as $key => $value) {
            echo '<option id = "optspecies_' . $value["recn"] . '" data-species="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    function listar_breeds() {
        $result = $this->M_tblbreeds->get_all_breeds();
        foreach ($result as $key => $value) {
            echo '<option id = "optbreeds_' . $value["recn"] . '" data-breeds="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SPECIES-BREEDS END///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////TRADERS//////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP ADD Traders////////////////////////////////////////////////////////////////////////////////////////
    function add_traders() {
        $data['d_name'] = $this->input->post('name');
        $data['d_type'] = $this->input->post('type');
        $result = $this->M_tbltraders->set_Traders($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Traders///////////////////////////////////////////////////////////////////////////////////////
    function edit_traders() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $data['d_type'] = $this->input->post('type');
        $result = $this->M_tbltraders->update_Traders($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    ////// Traders SETUP DELETE/////////////////////////////////////////////////////////////////////////////////////
    function delete_traders() {
        $idtrader = $this->input->post('recnactivo');
        $result = $this->M_tbltraders->del_Traders($idtrader[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE TRADERS//////////////////////////////////////////////////////////////////////////////////////
    function get_one_traders() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tbltraders->get_one_Traders($recn);
        print_r(json_encode($result));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// Traders LIST//////////////////////////////////////////////////////////////////////////////////////////////
    function listar_traders() {
        $type = $this->input->post('type');
        $result = $this->M_tbltraders->get_Traders_by_type($type);
        foreach ($result as $key => $value) {
            echo '<option id = "opttraders_' . $value["recn"] . '" data-traders="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////TRADERS END//////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TREATMENTNAMES//////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP ADD Treatmentnames////////////////////////////////////////////////////////////////////////////////////
    function add_treatmentnames() {
        $data['d_name'] = $this->input->post('name');
        $data['d_default'] = $this->input->post('default');
        $result = $this->M_tbltreatmentnames->set_Treatmentnames($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP EDIT Treatmentnames/////////////////////////////////////////////////////////////////////////////////
    function edit_treatmentnames() {
        $data['d_name'] = $this->input->post('name');
        $data['d_default'] = $this->input->post('default');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tbltreatmentnames->update_treaTmentnames($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP DELETE Treatmentnames/////////////////////////////////////////////////////////////////////////////////
    function delete_treatmentnames() {
        $idtreatmentnames = $this->input->post('recnactivo');
        $result = $this->M_tbltreatmentnames->del_Treatmentnames($idtreatmentnames[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Treatmentnames//////////////////////////////////////////////////////////////////////////////
    function get_one_treatmentnames() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tbltreatmentnames->get_one_Treatmentnames($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////LIST Treatmentnames/////////////////////////////////////////////////////////////////////////////////////////
    function listar_treatmentnames() {
        $result = $this->M_tbltreatmentnames->get_all_Treatmentnames();
        foreach ($result as $key => $value) {
            echo '<option id = "opttreatmentnames_' . $value["recn"] . '" data-treatmentnames="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////END TREATMENTNAMES//////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// UNITS///////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP ADD Units ///////////////////////////////////////////////////////////////////////////////////////
    function add_units() {
        $data['d_name'] = $this->input->post('name');
        $result = $this->M_tblunits->set_Units($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Units //////////////////////////////////////////////////////////////////////////////////////
    function edit_units() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblunits->update_Units($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP DELETE Uits ////////////////////////////////////////////////////////////////////////////////////
    function delete_units() {
        $idunits = $this->input->post('recnactivo');
        $result = $this->M_tblunits->del_Units($idunits[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Units////////////////////////////////////////////////////////////////////////////////////
    function get_one_units() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblunits->get_one_Units($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// LIST Owners //////////////////////////////////////////////////////////////////////////////////////////
    function listar_units() {
        $result = $this->M_tblunits->get_all_Units();
        foreach ($result as $key => $value) {
            echo '<option id = "optunits_' . $value["recn"] . '" data-units="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// UNITS END///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// VETERINARIANS////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP ADD Veterinarians ///////////////////////////////////////////////////////////////////////////////////////
    function add_veterinarians() {
        $data['d_name'] = $this->input->post('name');
        $result = $this->M_tblveterinarians->set_Veterinarians($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Veterinarians //////////////////////////////////////////////////////////////////////////////////////
    function edit_veterinarians() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblveterinarians->update_Veterinarians($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP DELETE Veterinarians ////////////////////////////////////////////////////////////////////////////////////
    function delete_veterinarians() {
        $idveterinarians = $this->input->post('recnactivo');
        $result = $this->M_tblveterinarians->del_veterinarians($idveterinarians[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Veterinarians////////////////////////////////////////////////////////////////////////////////////
    function get_one_veterinarians() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblveterinarians->get_one_Veterinarians($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// LIST Veterinarians //////////////////////////////////////////////////////////////////////////////////////////
    function listar_veterinarians() {
        $result = $this->M_tblveterinarians->get_all_Veterinarians();
        foreach ($result as $key => $value) {
            echo '<option id = "optveterinarians_' . $value["recn"] . '" data-traders="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// VETERINARIANS END////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// DISTRICTS////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP ADD Districts ///////////////////////////////////////////////////////////////////////////////////////
    function add_districts() {
        $data['d_name'] = $this->input->post('name');
        $data['d_region'] = $this->input->post('region');
        $result = $this->M_tbldistricts->set_Districts($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Districts //////////////////////////////////////////////////////////////////////////////////////
    function edit_districts() {
        $data['d_name'] = $this->input->post('name');
        $data['d_region'] = $this->input->post('region');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tbldistricts->update_Districts($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP DELETE Districts ////////////////////////////////////////////////////////////////////////////////////
    function delete_districts() {
        $iddistricts = $this->input->post('recnactivo');
        $result = $this->M_tbldistricts->del_Districts($iddistricts[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Districts////////////////////////////////////////////////////////////////////////////////////
    function get_one_districts() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tbldistricts->get_one_Districts($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// LIST Districts //////////////////////////////////////////////////////////////////////////////////////////
    function listar_districts() {
        $result = $this->M_tbldistricts->get_all_Districts();
        foreach ($result as $key => $value) {
            echo '<option id = "optdistricts_' . $value["recn"] . '" data-traders="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// DISTRICTS END////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// OWNERS///////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP ADD Owners ///////////////////////////////////////////////////////////////////////////////////////
    function add_owners() {
        $data['d_name'] = $this->input->post('name');
        $result = $this->M_tblowners->set_Owners($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP EDIT Owners //////////////////////////////////////////////////////////////////////////////////////
    function edit_owners() {
        $data['d_name'] = $this->input->post('name');
        $temp = $this->input->post('recn');
        $data['d_recn'] = $temp[0];
        $result = $this->M_tblowners->update_Owners($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// SETUP DELETE Owners ////////////////////////////////////////////////////////////////////////////////////
    function delete_owners() {
        $idowners = $this->input->post('recnactivo');
        $result = $this->M_tblowners->del_Owners($idowners[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE Owners////////////////////////////////////////////////////////////////////////////////////
    function get_one_owners() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tblowners->get_one_Owners($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// LIST Owners //////////////////////////////////////////////////////////////////////////////////////////
    function listar_owners() {
        $result = $this->M_tblowners->get_all_Owners();
        foreach ($result as $key => $value) {
            echo '<option id = "optowners_' . $value["recn"] . '" data-traders="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////// OWNERS END///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     ///////SETUP ADD testnames////////////////////////////////////////////////////////////////////////////////////
    function add_testnames() {
        $data['d_name'] = $this->input->post('name');
     
        $result = $this->M_tbltestnames->set_testnames($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP EDIT testnames/////////////////////////////////////////////////////////////////////////////////
    function edit_testnames() {
        $data['d_name'] = $this->input->post('name');
        
        $temp = $this->input->post('recn');
        
        $data['d_recn'] = $temp[0];
        $result = $this->M_tbltestnames->update_testnames($data);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully stored into the database.");
        } else {
            $estado = array("state" => "Your data has not been stored into the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////SETUP DELETE testnames/////////////////////////////////////////////////////////////////////////////////
    function delete_testnames() {
        $idtestnames = $this->input->post('recnactivo');
        $result = $this->M_tbltestnames->del_testnames($idtestnames[0]);
        if ($result > 0) {
            $estado = array("state" => "Your data has been successfully deleted from the database.");
        } else {
            $estado = array("state" => "Your data has not been deleted from the database.");
        }
        print_r(json_encode($estado));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////SETUP GET_ONE testnames//////////////////////////////////////////////////////////////////////////////
    function get_one_testnames() {
        $recn = $this->input->post('recnactivo');
        $recn = $recn[0];
        $result = $this->M_tbltestnames->get_one_testnames($recn);
        print_r(json_encode($result));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////LIST testnames/////////////////////////////////////////////////////////////////////////////////////////
    function listar_testnames() {
        $result = $this->M_tbltestnames->get_all_testnames();
        foreach ($result as $key => $value) {
            echo '<option id = "opttestnames_' . $value["recn"] . '" data-testnames="' . $value["name"] . '" value="' . $value["recn"] . '" >' . $value["name"] . '</option>';
        }
    }
}

// NO BORRAR. Llave de la clase