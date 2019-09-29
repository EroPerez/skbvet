<?php

class M_livestock extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblLivestock Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $IDNO = '';
    var $breedRecn = ''; //llave externa
    var $sex = '';
    var $dateOfBirth = '';
    var $localOrOverseas = '';
    var $arrivalDate = '';
    var $quarantinePeriod = '';
    var $quarantinePeriodUnits = '';
    var $countryOfOrigin = '';
    var $farmRecn = ''; //llave externa 
    var $populationOnFarm = '';
    var $dateAdded = '';
    var $importRecn = '';  //llave externa 
    var $exportRecn = '';  //llave externa 
    var $Transferred = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tblLivestock.
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//Construtor de la clase.

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
/// Esta funci�n inserta un elemento en la tabla.

    public function set_livestock($data) {
        //$this->recn = $data['d_recn'];   
        $this->IDNO = $data['d_IDNO'];
        $this->breedRecn = $data['d_breedRecn'];
        $this->sex = $data['d_sex'];
        $this->dateOfBirth = $data['d_dateOfBirth'];
        $this->localOrOverseas = $data['d_localOrOverseas'];
        $this->arrivalDate = $data['d_arrivalDate'];
        $this->quarantinePeriod = $data['d_quarantinePeriod'];
        $this->quarantinePeriodUnits = $data['d_quarantinePeriodUnits'];
        $this->countryOfOrigin = $data['d_countryOfOrigin'];
        $this->farmRecn = $data['d_farmRecn'];

        $this->dateAdded = $data['d_dateAdded'];

        /*
          $this->populationOnFarm = $data['d_populationOnFarm'];
          $this->importRecn = $data['d_importRecn'];
          $this->exportRecn = $data['d_exportRecn'];
          $this->Transferred = $data['d_Transferred'];
         */
        return $this->db->insert('tbllivestock', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_Livestock($data) {
        $this->recn = $data['d_recn'];
        $this->IDNO = $data['d_IDNO'];
        $this->breedRecn = $data['d_breedRecn'];
        $this->sex = $data['d_sex'];
        $this->dateOfBirth = $data['d_dateOfBirth'];
        $this->localOrOverseas = $data['d_localOrOverseas'];
        $this->arrivalDate = $data['d_arrivalDate'];
        $this->quarantinePeriod = $data['d_quarantinePeriod'];
        $this->quarantinePeriodUnits = $data['d_quarantinePeriodUnits'];
        $this->countryOfOrigin = $data['d_countryOfOrigin'];
        $this->farmRecn = $data['d_farmRecn'];
        // $this->populationOnFarm = $data['d_populationOnFarm'];   
        $this->dateAdded = $data['d_dateAdded'];
        // $this->importRecn = $data['d_importRecn'];  
        // $this->exportRecn = $data['d_exportRecn'];
        //  $this->Transferred = $data['d_Transferred'];

        $this->db->where('recn', $data['d_recn']);
        return $this->db->update('tbllivestock', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_Livestock($id) {
        return  $this->db->delete('tbllivestock', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_Livestock($data) {
        $this->db->select('tbllivestock.*');
        $this->db->from('tbllivestock');
        $this->db->like('IDNO', $data['d_IDNO']);
        $this->db->like('sex', $data['d_sex']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_Livestock() {
        $query = $this->db->get('tbllivestock');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_Livestock($id) {
        $query = $this->db->get_where('tbllivestock', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado de un farm.

    public function get_a_Livestock_by_farm($idfarm) {
        $query = $this->db->get_where('tbllivestock', array('farmRecn' => $idfarm));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

//lave de la clase  
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

