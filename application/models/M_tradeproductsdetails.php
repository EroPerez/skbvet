<?php

class M_tradeproductsdetails extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblTradeProductsDetails Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $commodityRecn = ''; // llave externa  
    var $dateOfTrade = '';
    var $weightInKG = '';
    var $country = '';
    var $tradeProductRecn = ''; // llave externa
    var $consignee_of_sender = '';
    var $consignee_of_receiver = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tbltradeproductsdetails.
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

    public function set_tradeproductsdetails($data) {
        //$this->recn = $data['d_recntpd'];   
        $this->commodityRecn = $data['d_sele_comimp_comm'];
        $this->dateOfTrade = $data['d_comimp_date_comm'];
        $this->weightInKG = $data['d_weight_comimp'];
        $this->country = $data['d_sele_comimp_contry'];
        $this->tradeProductRecn = $data['d_recntp'];
        $this->consignee_of_sender = $data['d_Consignee_of_sender'];
        $this->consignee_of_receiver = $data['d_Consignee_of_receiver'];

        return $this->db->insert('tbltradeproductsdetails', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_tradeproductsdetails($data) {
        $this->recn = $data['d_recntpd'];
        $this->commodityRecn = $data['d_sele_comimp_comm'];
        $this->dateOfTrade = $data['d_comimp_date_comm'];
        $this->weightInKG = $data['d_weight_comimp'];
        $this->country = $data['d_sele_comimp_contry'];
        $this->tradeProductRecn = $data['d_recntp'];
        $this->consignee_of_sender = $data['d_Consignee_of_sender'];
        $this->consignee_of_receiver = $data['d_Consignee_of_receiver'];

        $this->db->where('recn', $data['d_recntpd']);
        return $this->db->update('tbltradeproductsdetails', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeproductsdetails($id) {
        return $this->db->delete('tbltradeproductsdetails', array('recn' => $id));
    }

    /////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeproductsdetails_by($tradeProductRecn) {
        return $this->db->delete('tbltradeproductsdetails', array('tradeProductRecn' => $tradeProductRecn));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_tradeproductsdetails($data) {
        $this->db->select('tbltradeproductsdetails.*');
        $this->db->from('tbltradeproductsdetails');
        $this->db->like('dateOfTrade', $data['d_dateOfTrade']);
        $this->db->or_like('country', $data['d_country']);

        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeproductsdetails() {
        $query = $this->db->get('tbltradeproductsdetails');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_tradeproductsdetails($id) {
        $query = $this->db->get_where('tbltradeproductsdetails', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos lo atributos de todos los commodities que pertenecen al tradeproduct solicitado.

    public function get_tradeproductsdetails_by_tradeproducts($idtradeproducts) {
        $this->db->select('tbltradeproductsdetails.*,tbltradeproductsdetails.recn AS recntpd, tblcommodities.*,tblcountries.name AS namep');
        $this->db->from('tbltradeproductsdetails');
        $this->db->join('tblcommodities', 'tbltradeproductsdetails.commodityRecn = tblcommodities.recn');
        $this->db->join('tblcountries', 'tbltradeproductsdetails.country = tblcountries.recn');
        $this->db->where('tradeProductRecn', $idtradeproducts);
        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

//llave de la clase   
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

