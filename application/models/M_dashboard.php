<?php

class M_Dashboard extends CI_Model {

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase M_Dashboard.
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//Construtor de la clase.

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getMapData() {
        $query = $this->db->get('map_view');
        return $query->result_array();
    }

    public function getAnimalByDistricts() {
        $this->db->select('name,total');
        $query = $this->db->get('animalbydistricts_view');
        return $query->result_array();
    }

    public function getCaseByDistricts() {
        $this->db->select('name,total');
        $query = $this->db->get('casebydistricts_view');
        return $query->result_array();
    }

    public function getFarmByDistricts() {
        $this->db->select('name,total');
        $query = $this->db->get('farmbydistricts_view');
        return $query->result_array();
    }

    public function getTotalAnimalTestedByFarm() {
        $this->db->select('farmName,total');
        $query = $this->db->get('totalanimaltestedbyfarm_view');
        return $query->result_array();
    }

    public function getNumberOfAnimalImportedBySpecies() {
        $this->db->select('species,total');
        $query = $this->db->get('numberofanimalimportedbyspecies_view');
        return $query->result_array();
    }

    public function getTotaloMeatImportedByCommodity() {
        $this->db->select('commodity,total');
        $query = $this->db->get('totalofmeatimportedbycommodity_view');
        return $query->result_array();
    }

    public function getNumberSpecimenPermitIssuedByYear() {
        $this->db->select('year,total');
        $query = $this->db->get('numberspecimenpermitissuedbyyear_view');
        return $query->result_array();
    }

}

//llave de la clase  
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

