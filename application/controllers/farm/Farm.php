<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Farm extends My_Controller {

    var $header_view, $footer_view, $data_template = NULL, $accesos, $auth;

    function __construct() {

        parent::__construct();

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_farmers', 'M_livestock', 'M_farms', 'M_tblunits', 'M_tbldistricts', 'M_tblspecies', 'M_tblbreeds', 'M_tblcountries', 'M_transfers', 'M_casedetails'));

        //new authentication method
        $this->auth->route_access();

    }

    function index($action, $recn = NULL) {

        $data['title'] = 'Farmer\'s Information';
        $data['sizeunits'] = $this->M_tblunits->get_units_by_type(1);
        $data['sizeunits2'] = $this->M_tblunits->get_units_by_type(2);
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['contry'] = $this->M_tblcountries->get_all_Countries();
        $data['species'] = $this->M_tblspecies->get_all_Species();
        $data['pag'] = 'farm';

        $operation = array('action' => $action, 'recn' => $recn);

        $this->data_template['script'] = $this->load->view('pages/s_farm', $operation, TRUE);

        $this->render('pages/farm_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function farm_list() {

        $data = array();
        try {
            $data['title'] = 'Farmer\'s List';
            $data['pag'] = '';

            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tblfarms');
            $crud->set_subject('Farmer');
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_jquery();
//            $crud->unset_
            $crud->set_relation('farmerRecn', 'tblfarmers', '{fName} {lName}', NULL, 'farmerRecn ASC');
            $crud->set_relation('districtRecn', 'tbldistricts', 'name');
            $crud->set_relation('sizeUnits', 'tblunits', 'name');
            $crud->columns('farmerRecn', 'farmName', 'location', 'size', 'sizeUnits', 'districtRecn');
            $crud->display_as('farmerRecn', 'Farmer')
              ->display_as('farmName', 'Farm Name')
              ->display_as('sizeUnits', 'Size Units')
              ->display_as('districtRecn', 'District')
              ->order_by('recn', 'desc');

            $crud->add_action('View', '', '', 'ui-icon-document', array($this, 'crud_view_action'));
            $crud->add_action('Edit', '', '', 'ui-icon-pencil', array($this, 'crud_edit_action'));
            $crud->callback_delete(array($this, 'delete_farmer_callback'));

            $obj = $crud->render();
            $data['output'] = $obj->output;

            $this->data_template['js_files'] = $obj->js_files;
            $this->data_template['css_files'] = $obj->css_files;
            $this->data_template['script'] = $this->load->view('pages/s_farm', array('action' => '', 'recn' => ''), TRUE);

            $this->render('admin/list_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);
        }
        catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function crud_edit_action($primary_key, $row) {
        return site_url('farm/farmers/edit') . '/' . $row->farmerRecn;

    }

    function crud_view_action($primary_key, $row) {
        return site_url('farm/farmers/read') . '/' . $row->farmerRecn;

    }

    public function delete_farmer_callback($primary_key) {
        $farm = $this->M_farms->get_a_farms($primary_key);
        return $this->M_farmers->del_farmers($farm[0]['farmerRecn']);

    }

    /////////////////////////////////////////////////////
    ///////ADD FARM //////////////////////////////////// 
    function farm_add_edit() {
        $datosFarmer = array();
        $datosFarm = array();
        $this->form_validation->set_rules('date_addfarmer', 'date_addfarmer', 'required');
        $this->form_validation->set_rules('farmer_firstname', 'farmer_firstname', 'required');
        $this->form_validation->set_rules('farmer_lastname', 'farmer_lasttname', 'required');
        $this->form_validation->set_rules('farmer_address', 'farmer_address', 'required');
        $this->form_validation->set_rules('farmer_phone', 'farmer_phone', 'required');
        $this->form_validation->set_rules('farmname', 'farmname', 'required');
        $this->form_validation->set_rules('farm_location', 'farm_location', 'required');
        $this->form_validation->set_rules('farm_parish', 'farm_parish', 'required');
        $this->form_validation->set_rules('farm_size', 'farm_size', 'required');
        $this->form_validation->set_rules('farm_sizeunit', 'farm_sizeunit', 'required');
        if ($this->form_validation->run() == FALSE) {
            $estado = array("state" => "All data are required", 'success' => FALSE);
            print_r(json_encode($estado));
        }
        else {
            date('F j, Y \a\t g:i A', strtotime($this->input->post('date_addfarmer')));

            $datosFarmer = array(
              'd_recn' => $this->input->post('recfarmer'),
              'd_dateAdded' => date('Y-m-d', strtotime($this->input->post('date_addfarmer'))),
              'd_fName' => $this->input->post('farmer_firstname'),
              'd_lName' => $this->input->post('farmer_lastname'),
              'd_address1' => $this->input->post('farmer_address'),
              'd_Phone' => $this->input->post('farmer_phone'),
            );
            /// IDENTIFICAR PARA HACER UN EDIT O UN ADD/////
            $id_farmerRecn = 0;
            if ($this->input->post('edit') === '0')
                $id_farmerRecn = $this->M_farmers->set_farmers($datosFarmer);
            else {
                $id_farmerRecn = $this->M_farmers->update_farmers($datosFarmer);
            }

            if ($id_farmerRecn > 0) {

                $datosFarm = array(
                  'd_recn' => $this->input->post('recfarm'),
                  'd_farmName' => $this->input->post('farmname'),
                  'd_location' => $this->input->post('farm_location'),
                  'd_districtRecn' => $this->input->post('farm_parish'),
                  'd_size' => $this->input->post('farm_size'),
                  'd_sizeUnits' => $this->input->post('farm_sizeunit'),
                  'd_farmerRecn' => $id_farmerRecn
                );
                $id_farm = 0;
                if ($this->input->post('edit') === '0')
                    $id_farm = $this->M_farms->set_farms($datosFarm);
                else
                    $id_farm = $this->M_farms->update_farms($datosFarm);

                if ($id_farm > 0) {
                    $estado = array(
                      "state" => "Your data has been successfully stored into the database.",
                      "farmer" => array('recn' => $id_farmerRecn, 'fullname' => $datosFarmer['d_fName'] . ' ' . $datosFarmer['d_lName']),
                      "farm" => array('recn' => $id_farm, 'farmName' => $datosFarm['d_farmName']),
                      'success' => TRUE
                    );
                    print_r(json_encode($estado));
                }
                else {
                    $estado = array("state" => "The data you had insert may not be saved.", 'success' => FALSE);
                    print_r(json_encode($estado));
                }
            }
            else {
                $estado = array("state" => "Could not insert or update farmer data into database.", 'success' => FALSE);
                print_r(json_encode($estado));
            }
        }

    }

    //////////////////////////////////////////////
    /* eliminar farmers */
    function farm_delete() {

        $id_farmer = $this->input->post('recn');
        //$farmer = $this->M_farmers->get_a_farmers($id_farmer);
        $farm = $this->M_farms->get_farms_by_farmer($id_farmer);
        $del_farmer = $this->M_farmers->del_farmers($id_farmer);
        if ($del_farmer != 0) {
            if (count($farm) > 0)
                $this->M_farms->del_farms($farm[0]['recn']);

            print_r(json_encode(array('state' => TRUE, 'delete' => 'Your data has been successfully deleted from the database.')));
        }
        else
            print_r(json_encode(array('state' => FALSE, 'delete' => 'Your data was not deleted from the database.')));

    }

    ////////////////////////////////////////////////
    ///Navegar forwards por la base//
    function farmer_forward() {


        $page = $this->input->post('page');
        $all_farmers = $this->M_farmers->get_farmers();

        if ($page + 1 > count($all_farmers) || $page <= 0) {
            $page = 1;
        }
        else {
            $page = $page + 1;
        }
        $registers_farmer = $this->M_farmers->get_farmers_pagination($page - 1);
        $results = $this->get_farmer_data($registers_farmer);



        $results['page'] = $page;

        print_r(json_encode($results));

    }

///////////////////////////////////// 
    /* Navegar backwards por la base */
    function farmer_backward() {

        $page = $this->input->post('page');
        $all_farmers = $this->M_farmers->get_farmers();

        if ($page - 1 <= 0 || $page > count($all_farmers)) {

            $page = count($all_farmers);
        }
        else {
            $page = $page - 1;
        }


        $registers_farmer = $this->M_farmers->get_farmers_pagination($page - 1);
        $results = $this->get_farmer_data($registers_farmer);



        $results['page'] = $page;

        print_r(json_encode($results));

    }

////////////////////////////////////////////////////////////////
/////////////MOSTRAR TODA DATA OF FARMER ////////////////////////////////
    function get_farmer_data($farmer) {
        $registers_farmer = $farmer;

        $registers_farm = array();
        if (count($farmer) > 0)
            $registers_farm = $this->M_farms->get_farms_by_farmer($farmer[0]['recn']);

        $register_parish = array();
        $regiter_livestock = array();
        $size_reg = array();
        if (count($registers_farm) > 0) {
            $register_parish = $this->M_tbldistricts->get_one_Districts($registers_farm[0]['districtRecn']);

            $regiter_livestock = $this->M_livestock->get_a_Livestock_by_farm($registers_farm[0]['recn']);


            $register_sizeunit = $this->M_tblunits->get_one_Units($registers_farm[0]['sizeUnits']);
            if (count($register_sizeunit) > 0)
                $size_reg = $register_sizeunit[0]['recn'];
        }

        $parish_reg = array();
        if (count($register_parish) > 0)
            $parish_reg = $register_parish[0]['recn'];


        $result = array('farmer' => $registers_farmer, 'farm' => $registers_farm, 'livestock' => $regiter_livestock, 'district' => $parish_reg, 'size' => $size_reg, 'sizeunits' => $size_reg);


        return $result;

    }

    function save_farmer() {
        
    }

/////////////////////////////////////////////////
/////search a farmer////////
    function farmer_search() {

        $name = $this->input->post('name');
        $datos_farmer = array('d_recn' => $name, 'd_fName' => $name, 'd_lName' => $name, 'd_address1' => $name, 'd_dateAdded' => $name);
        $result = $this->M_farmers->find_farmers($datos_farmer);

        print_r(json_encode($this->get_farmer_data($result)));

    }

    /////////////////////////////////////////////////
/////Get by ID a farmer////////
    function farmer_get_by_id() {

        $id = $this->input->post('farmerRecn');
        $result = $this->M_farmers->get_a_farmers($id);

        print_r(json_encode($this->get_farmer_data($result)));

    }

////////////////////////////////////////////////////////////////
///// llenar el option breeds en livestock segun species ///////
    function breeds_species() {
        $recn = $this->input->post('recn');
        $result = $this->M_tblbreeds->get_breeds_by_species($recn);
        foreach ($result as $value) {
            echo '<option value="' . $value["recn"] . '">' . $value["name"] . '</option>';
        }
//  print_r(json_encode($result));

    }

////////////////////////////////////////////////////////////////
///// Listar Livestock ///////
    function listar_livestock() {

        $idfarm = $this->input->post('recn');
        $livestock = $this->M_livestock->get_a_Livestock_by_farm($idfarm);
        foreach ($livestock as $key => $value) {
            $temp1 = $this->M_tblbreeds->get_one_Breeds($value['breedRecn']);
            $livestock[$key]['breed'] = $temp1[0]['name'];
            $temp2 = $this->M_tblspecies->get_one_Species($temp1[0]['speciesrecn']);
            $livestock[$key]['species'] = $temp2[0]['name'];
            $livestock[$key]['age'] = $this->Age($value['dateOfBirth']);
            $livestock[$key]['transfer'] = $this->M_transfers->get_a_transfers_by_live($value['recn']);
        }
        print_r(json_encode($livestock));

    }

////////////////////////////////////////////////////////////////
///// sumar Livestock ///////
    function add_livestock() {

        $data['d_recn'] = $this->input->post('recnlivestock');
        $data['d_farmRecn'] = $this->input->post('recfarm');
        $data['d_dateAdded'] = $this->input->post('livestock_dateadd');
        $data['d_IDNO'] = $this->input->post('livestock_id');
        $data['species'] = $this->input->post('livestock_species');
        $data['d_breedRecn'] = $this->input->post('livestock_breeds');
        $data['d_sex'] = $this->input->post('livestock_sex');
        // $data['d_dateOfBirth'] = $this->input->post('livestock_datebirth');
        $data['d_countryOfOrigin'] = $this->input->post('livestock_contry');
        $data['d_localOrOverseas'] = $this->input->post('rlivestock');
        $data['d_arrivalDate'] = $this->input->post('livestock_datearrival');
        $data['d_quarantinePeriod'] = $this->input->post('livestock_quara_period');
        $data['d_quarantinePeriodUnits'] = $this->input->post('livestock_Quarantine_unit');
        //Recalcular la fecha de nacimientosi es posible
        $yearofbirth = $this->input->post('livestock_yearofbirth');
        $monthofbirth = $this->input->post('livestock_datebirth');
        $res = FALSE;
        $date = new \DateTime('now');

        if (!empty($yearofbirth)) {
            $date->modify('-' . $yearofbirth . 'years');
        }

        if (!empty($monthofbirth)) {
            $date->modify('-' . $monthofbirth . 'month');
        }

        $data['d_dateOfBirth'] = $date->format('Y-m-d');

        if ($this->input->post('addlivestock') === 'true') {
            $res = $this->M_livestock->set_livestock($data);
        }
        else
            $res = $this->M_livestock->update_Livestock($data);

        print_r(json_encode($res));

    }

////////////////////////////////////////////////////////////////
///// borrar livestock ///////
    function delete_livestock() {

        $idlive = $this->input->post('reclive');
        $res = $this->M_livestock->del_Livestock($idlive);
        print_r(json_encode($res));

    }

////////////////////////////////////////////////////////////////
///// listar transfer ///////
    function listar_livestock_transf() {
        $idlive = $this->input->post('reclive');
        $data_transfer = $this->M_transfers->get_a_transfers_by_live($idlive);
        if (count($data_transfer) > 0) {
            foreach ($data_transfer as $key => $transfer) {
                $fromfarm = $this->M_farms->get_a_farms($transfer['FromFarmRecn']);
                $tofarm = $this->M_farms->get_a_farms($transfer['ToFarmRecn']);
                $data_transfer[$key]['fromtranf'] = $fromfarm[0]['farmName'];
                $data_transfer[$key]['totranf'] = $tofarm[0]['farmName'];
            }
        }
        print_r(json_encode($data_transfer));

    }

////////////////////////////////////////////////////////////////
///// listar contry ///////
    function contry() {

        $result = $this->M_tblcountries->get_Countries_by_type();
        print_r(json_encode($result));

    }

////////////////////////////////////////////////////////////////
///// mostrar campo Edad ///////
    function Age($date) {
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($date);
        $interval = $datetime1->diff($datetime2);
        $res = 'Without age';
        if ((int) $interval->format('%y') > 1) {
            if ((int) $interval->format('%m') > 1) {
                $res = $interval->format('%y years, %m months');
            }
            else if ((int) $interval->format('%m') > 0) {
                $res = $interval->format('%y years, %m month');
            }
            else {
                $res = $interval->format('%y years');
            }
        }
        else if ((int) $interval->format('%y') > 0) {
            if ((int) $interval->format('%m') > 1) {
                $res = $interval->format('%y year, %m months');
            }
            else if ((int) $interval->format('%m') > 0) {
                $res = $interval->format('%y year, %m month');
            }
            else {
                $res = $interval->format('%y year');
            }
        }
        else {
            if ((int) $interval->format('%m') > 1) {
                $res = $interval->format('%m months');
            }
            else if ((int) $interval->format('%m') > 0) {
                $res = $interval->format('%m month');
            }
        }

        return $res;

    }

////////////////////////////////////////////////////////////////
///// mostrar campo Year ///////
    function Years($date) {
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($date);
        $interval = $datetime1->diff($datetime2);
        $res = $interval->format('%y');
        return $res;

    }

    ////////////////////////////////////////////////////////////////
///// mostrar campo Month ///////
    function Months($date) {
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($date);
        $interval = $datetime1->diff($datetime2);
        $res = $interval->format('%m');
        return $res;

    }

////////////////////////////////////////////////////////////////
///// editar livestock ///////
    function edit_livestock() {

        $id = $this->input->post('recnlive');
        $res = $this->M_livestock->get_a_Livestock($id);
        $species = $this->M_tblbreeds->get_one_Breeds($res[0]['breedRecn']);
        $res[0]['species'] = $species[0]['speciesrecn'];
        $res[0]['breed'] = $species[0]['name'];
        $res[0]['years'] = $this->Years($res[0]['dateOfBirth']);
        $res[0]['months'] = $this->Months($res[0]['dateOfBirth']);
        print_r(json_encode($res));

    }

    function illness_livestock() {
        $livestockRecn = $this->input->post('livestockRecn');
        $res = $this->M_casedetails->get_case_by_animal($livestockRecn);
        print_r(json_encode($res));

    }

}

/* end de la class*/
   
