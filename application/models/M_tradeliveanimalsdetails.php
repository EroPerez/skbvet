<?php

class M_tradeliveanimalsdetails extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblTradeLiveAnimalsDetails Atributos ////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $tradeLiveAnimalRecn = ''; //llave externa  
    var $dateOfTrade = '';
    var $breedRecn = '';  //llave externa
    var $quantity = '';
    var $country = '';
    var $quarantinePeriod = '';
    var $quarantinePeriodUnit = '';
    var $tradeStatus = '';
    var $comments = '';
    var $consignee_of_sender = '';
    var $consignee_of_receiver = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tbltradeproducts.
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

    public function set_tradeliveanimalsdetails($data) {
        //$this->recn = $data['d_recn'];   
        $this->tradeLiveAnimalRecn = $data['d_recntp'];
        $this->dateOfTrade = $data['d_animalimp_dateadd'];
        $this->breedRecn = $data['d_animalimp_breeds'];
        $this->quantity = $data['d_animalimp_quantity'];
        $this->country = $data['d_animalimp_origin'];
        $this->quarantinePeriod = $data['d_animalimp_quara_period'];
        $this->quarantinePeriodUnit = $data['d_animalimp_quarantine_unit'];
        $this->tradeStatus = $data['d_animalimp_status'];
        $this->comments = $data['d_animalimp_comment'];
        $this->consignee_of_sender = $data['d_Consignee_of_sender'];
        $this->consignee_of_receiver = $data['d_Consignee_of_receiver'];
        
        $query = $this->db->insert('tbltradeliveanimalsdetails', $this);
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_tradeliveanimalsdetails($data) {
        $this->recn = $data['d_recntpd'];
        $this->tradeLiveAnimalRecn = $data['d_recntp'];
        $this->dateOfTrade = $data['d_animalimp_dateadd'];
        $this->breedRecn = $data['d_animalimp_breeds'];
        $this->quantity = $data['d_animalimp_quantity'];
        $this->country = $data['d_animalimp_origin'];
        $this->quarantinePeriod = $data['d_animalimp_quara_period'];
        $this->quarantinePeriodUnit = $data['d_animalimp_quarantine_unit'];
        $this->tradeStatus = $data['d_animalimp_status'];
        $this->comments = $data['d_animalimp_comment'];
         $this->consignee_of_sender = $data['d_Consignee_of_sender'];
        $this->consignee_of_receiver = $data['d_Consignee_of_receiver'];
        $this->db->where('recn', $data['d_recntpd']);
        $query = $this->db->update('tbltradeliveanimalsdetails', $this);
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeliveanimalsdetails($id) {
        $query = $this->db->delete('tbltradeliveanimalsdetails', array('recn' => $id));
        return $query;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeliveanimalsdetails_by($tradeLiveAnimalRecn) {
        $query = $this->db->delete('tbltradeliveanimalsdetails', array('tradeLiveAnimalRecn' => $tradeLiveAnimalRecn));
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_tradeliveanimalsdetails($data) {
        $this->db->select('tbltradeliveanimalsdetails.*');
        $this->db->from('tbltradeliveanimalsdetails');
        $this->db->like('dateOfTrade', $data['d_dateOfTrade']);
        $this->db->like('country', $data['d_country']);
        $this->db->like('tradeStatus', $data['d_tradeStatus']);

        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeliveanimalsdetails() {
        $query = $this->db->get('tbltradeliveanimalsdetails');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_tradeliveanimalsdetails($id) {
        //$query = $this->db->get_where('tbltradeliveanimalsdetails', array('recn' => $id));
        //return $query->result_array(); 

        $this->db->select('tbltradeliveanimalsdetails.*, tbltradeliveanimalsdetails.recn AS recntpd, tblcountries.name AS namep,tblspecies.recn AS names,tblbreeds.name AS nameb');
        $this->db->from('tbltradeliveanimalsdetails');
        $this->db->join('tblcountries', 'tbltradeliveanimalsdetails.country = tblcountries.recn');
        $this->db->join('tblbreeds', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tblspecies', 'tblbreeds.speciesRecn = tblspecies.recn');
        $this->db->where('tbltradeliveanimalsdetails.recn', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos lo atributos de todos los animals que pertenecen al tradeliveanimal solicitado.

    public function get_tradeliveanimalsdetails_by_tradeliveanimals($idtradeliveanimals) {
        $this->db->select('tbltradeliveanimalsdetails.*, tbltradeliveanimalsdetails.recn AS recntpd, tblcountries.name AS namep,tblspecies.name AS names,tblbreeds.name AS nameb');
        $this->db->from('tbltradeliveanimalsdetails');
        $this->db->join('tblcountries', 'tbltradeliveanimalsdetails.country = tblcountries.recn');
        $this->db->join('tblbreeds', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tblspecies', 'tblbreeds.speciesRecn = tblspecies.recn');
        $this->db->where('tradeLiveAnimalRecn', $idtradeliveanimals);
        $query = $this->db->get();
        return $query->result_array();
    }

}

//llave de la clase   
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

