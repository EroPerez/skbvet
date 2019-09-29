<?php

class M_tradeproducts extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblTradeProducts Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $tradeType = '';
    var $dateOfLicence = '';
    var $licenceNo = '';
    var $fee = '';
    var $FarmRecn = ''; //OJO puede estar cambiado

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

    public function set_tradeproducts($data) {
        //$this->recn = $data['d_recn'];   
        $this->tradeType = $data['d_tradeType'];
        $this->dateOfLicence = $data['d_dateOfLicence'];
        $this->licenceNo = $data['d_licenceNo'];
        $this->fee = $data['d_fee'];
        $this->FarmRecn = $data['d_FarmRecn'];

        $this->db->insert('tbltradeproducts', $this);
        $resultado = $this->db->insert_id();
        return $resultado;
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_tradeproducts($data) {
        $this->recn = $data['d_recn'];
        $this->tradeType = $data['d_tradeType'];
        $this->dateOfLicence = $data['d_dateOfLicence'];
        $this->licenceNo = $data['d_licenceNo'];
        $this->fee = $data['d_fee'];
        $this->FarmRecn = $data['d_FarmRecn'];

        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tbltradeproducts', $this);
        $resultado = $this->recn;
        return $resultado;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeproducts($id) {
        $resultado = $this->db->delete('tbltradeproducts', array('recn' => $id));
        return $resultado;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_tradeproducts($data) {
        $this->db->select('tbltradeproducts.*');
        $this->db->from('tbltradeproducts');
        $this->db->where('tradeType', $data['d_tradeType']);
        $this->db->like('licenceNo', $data['d_licenceNo']);
//        $this->db->or_like('fee', $data['d_fee']);


        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeproducts() {
        $query = $this->db->get('tbltradeproducts');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeproducts_impexp($impexp) {
        $query = $this->db->get_where('tbltradeproducts', array('tradeType' => $impexp));
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_tradeproducts($id) {
        $query = $this->db->get_where('tbltradeproducts', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes(import licences )
    // Total # of poultry meats per (Quarter and Yearly) 
    // Total # of pork meats per (Quarter and Yearly) 
    // Total # of Beef meats per (Quarter and Yearly) 
    // Total # of Mutton meats per (Quarter and Yearly)
    public function get_yearly_import_licences($year, $commodities = null) {
        $this->db->distinct();
        $this->db->select('tblcommodities.name AS Commodities,SUM(tbltradeproductsdetails.weightInKG) AS TotalWeightInKG');
        $this->db->from('tbltradeproducts');
        $this->db->join('tbltradeproductsdetails', 'tbltradeproducts.recn  = tbltradeproductsdetails.tradeProductRecn');
        $this->db->join('tblcommodities', 'tbltradeproductsdetails.commodityRecn = tblcommodities.recn');
        $this->db->where('tbltradeproducts.tradeType = 1');
        $this->db->where('YEAR(tbltradeproducts.dateOfLicence)', $year);
        $this->db->group_by('tblcommodities.name');

        if ($commodities) {
            $this->db->having('tblcommodities.name', $commodities);
        }

        $query = $this->db->get();


        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes(import licences )
    // Total # of poultry meats per (Quarter and Yearly) 
    // Total # of pork meats per (Quarter and Yearly) 
    // Total # of Beef meats per (Quarter and Yearly) 
    // Total # of Mutton meats per (Quarter and Yearly)
    public function get_quarter_import_licences($start_quarter, $commodities = null) {
        $this->db->distinct();
        $this->db->select('tblcommodities.name AS Commodities,SUM(tbltradeproductsdetails.weightInKG) AS TotalWeightInKG');
        $this->db->from('tbltradeproducts');
        $this->db->join('tbltradeproductsdetails', 'tbltradeproducts.recn  = tbltradeproductsdetails.tradeProductRecn');
        $this->db->join('tblcommodities', 'tbltradeproductsdetails.commodityRecn = tblcommodities.recn');
        $this->db->where('tbltradeproducts.tradeType = 1');
        $this->db->where("tbltradeproducts.dateOfLicence BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");
        $this->db->group_by('tblcommodities.name');

        if (isset($commodities)) {
            $this->db->having('tblcommodities.name', $commodities);
//            echo $this->db->last_query();
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes(import licences )
    // Total # of poultry meats per (Quarter and Yearly) 
    // Total # of pork meats per (Quarter and Yearly) 
    // Total # of Beef meats per (Quarter and Yearly) 
    // Total # of Mutton meats per (Quarter and Yearly)
    public function get_yearly_export_licences($year) {
        $this->db->distinct();
        $this->db->select("tblcountries.name AS `Country/Address of destination`,  'St. Kitts and Nevis' as 'Country/Address of origin',
  tbltradeproductsdetails.consignee_of_sender AS `Consignee of sender`, tbltradeproductsdetails.consignee_of_receiver AS `Consignee of receiver`,
  tblcommodities.name AS `ID of Meats`", FALSE);
        $this->db->from('tbltradeproducts');
        $this->db->join('tbltradeproductsdetails', 'tbltradeproducts.recn  = tbltradeproductsdetails.tradeProductRecn');
        $this->db->join('tblcountries', 'tbltradeproductsdetails.country = tblcountries.recn');
        $this->db->join('tblcommodities', 'tbltradeproductsdetails.commodityRecn = tblcommodities.recn');
        $this->db->where('tbltradeproducts.tradeType = 2');
        $this->db->where('YEAR(tbltradeproducts.dateOfLicence)', $year);

        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes(import licences )
    // Total # of poultry meats per (Quarter and Yearly) 
    // Total # of pork meats per (Quarter and Yearly) 
    // Total # of Beef meats per (Quarter and Yearly) 
    // Total # of Mutton meats per (Quarter and Yearly)
    public function get_quarter_export_licences($start_quarter) {
        $this->db->distinct();
        $this->db->select("tblcountries.name AS `Country/Address of destination`,  'St. Kitts and Nevis' as 'Country/Address of origin',
  tbltradeproductsdetails.consignee_of_sender AS `Consignee of sender`, tbltradeproductsdetails.consignee_of_receiver AS `Consignee of receiver`,
  tblcommodities.name AS `ID of Meats`", FALSE);
        $this->db->from('tbltradeproducts');
        $this->db->join('tbltradeproductsdetails', 'tbltradeproducts.recn  = tbltradeproductsdetails.tradeProductRecn');
        $this->db->join('tblcountries', 'tbltradeproductsdetails.country = tblcountries.recn');
        $this->db->join('tblcommodities', 'tbltradeproductsdetails.commodityRecn = tblcommodities.recn');
        $this->db->where('tbltradeproducts.tradeType = 2');
        $this->db->where("tbltradeproducts.dateOfLicence BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");

        $query = $this->db->get();
//        echo $this->db->last_query();

        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla paginados.

    public function get_tradeproducts_pagination($page, $tradeType) {
        $this->db->where(array('tradeType' => $tradeType));
        $query = $this->db->get('tbltradeproducts', 1, $page);
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

// llave de la clase  
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

