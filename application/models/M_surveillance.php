<?php

class M_surveillance extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblsurveillance Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $farmRecn = '';
    var $testRecn = '';
    var $dateOfSurveillance = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase Surveillance.
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

    public function set_surveillance($data) {
        //$this->recn = $data['d_recn'];   
        $this->farmRecn = $data['farmRecn'];
        $this->testRecn = $data['testRecn'];
        $this->dateOfSurveillance = $data['dateOfSurveillance'];

        $resultado = $this->db->insert('tblsurveillance', $this);
        return  $this->db->insert_id(); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_surveillance($data) {
        $this->recn = $data['recn'];
        $this->farmRecn = $data['farmRecn'];
        $this->testRecn = $data['testRecn'];
        $this->dateOfSurveillance = $data['dateOfSurveillance'];

        $this->db->where('recn', $data['recn']);
        $this->db->update('tblsurveillance', $this);
        return  $this->recn; 
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_surveillance($id) {
        $result = $this->db->delete('tblsurveillance', array('recn' => $id));
        return $result;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_surveillance($data) {
        $this->db->select('tblsurveillance.*');
        $this->db->from('tblsurveillance');
        $this->db->or_like('farmRecn', $data['d_farmRecn']);
        $this->db->or_like('testRecn', $data['d_testRecn']);
        $this->db->like('dateOfSurveillance', $data['d_dateOfSurveillance']);
        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_surveillance() {
        $query = $this->db->get('tblsurveillance');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_surveillance($id) {
        $query = $this->db->get_where('tblsurveillance', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Surveillance data report yearly

    public function get_yearly_surveillancedata($year) {
        $this->db->distinct();
        $this->db->select(" tblsurveillance.recn, CONCAT(tblfarmers.fName, ' ', tblfarmers.lName) AS `name of farmer`, "
                . "tblfarms.farmName AS `name of farm`, "
                . "tbllivestock.IDNO AS `ID of animal`, "
                . "tbltestnames.name AS `test performed`,  "
                . "tblsurveillancedetails.testResult as 'test result'", FALSE);
        $this->db->from('tblsurveillancedetails');
        $this->db->join('tblsurveillance', 'tblsurveillancedetails.surveillanceRecn = tblsurveillance.recn');
        $this->db->join('tbllivestock', 'tblsurveillancedetails.livestockRecn = tbllivestock.recn');
        $this->db->join('tbltestnames', 'tblsurveillance.testRecn = tbltestnames.recn');
        $this->db->join('tblfarms', 'tblsurveillance.farmRecn = tblfarms.recn');
        $this->db->join('tblfarmers', 'tblfarms.farmerRecn = tblfarmers.recn');

        $this->db->where('YEAR(tblsurveillance.dateOfSurveillance)', $year);
        $query = $this->db->get();
        $rows = $query->result_array();
        return array('rows' => $this->_normalize($rows), 'total number of animal tested' => count($rows));
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Surveillance data report quarterly

    public function get_quarterly_surveillancedata($start_quarter) {
        $this->db->distinct();
        $this->db->select(" tblsurveillance.recn, CONCAT(tblfarmers.fName, ' ', tblfarmers.lName) AS `name of farmer`,"
                . " tblfarms.farmName AS `name of farm`,"
                . " tbllivestock.IDNO AS `ID of animal`,"
                . " tbltestnames.name AS `test performed`,"
                . " tblsurveillancedetails.testResult as 'test result'", FALSE);
        $this->db->from('tblsurveillancedetails');
        $this->db->join('tblsurveillance', 'tblsurveillancedetails.surveillanceRecn = tblsurveillance.recn');
        $this->db->join('tbllivestock', 'tblsurveillancedetails.livestockRecn = tbllivestock.recn');
        $this->db->join('tbltestnames', 'tblsurveillance.testRecn = tbltestnames.recn');
        $this->db->join('tblfarms', 'tblsurveillance.farmRecn = tblfarms.recn');
        $this->db->join('tblfarmers', 'tblfarms.farmerRecn = tblfarmers.recn');

        $this->db->where("tblsurveillance.dateOfSurveillance BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");
        $query = $this->db->get();
        $rows = $query->result_array();
        return array('rows' => $this->_normalize($rows), 'total number of animal tested' => count($rows));
    }

    private function _normalize($rows) {
        $data = array();
        foreach ($rows as $row) {
            if (!isset($data[$row['recn']])) {
                $data[$row['recn']] = array();
                $data[$row['recn']]['name of farmer'] = $row['name of farmer'];
                $data[$row['recn']]['name of farm'] = $row['name of farm'];
                $data[$row['recn']]['test performed'] = $row['test performed'];
            }
            $data[$row['recn']]['animal tested'][] = array('ID of animal' => $row['ID of animal'], 'test result' => $row['test result']);
        }
        return $data;
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////
    //Stock de animales por surveillance
    function liveanimalBySurveillance($idSurveillance){
        $this->db->select('tbllivestock.IDNO as IDNO, tblsurveillancedetails.testResult AS testResult, tblsurveillancedetails.recn as recnd');
        $this->db->from('tbllivestock');
        $this->db->join('tblsurveillancedetails', 'tbllivestock.recn = tblsurveillancedetails.livestockRecn');
        $this->db->where('tblsurveillancedetails.surveillanceRecn', $idSurveillance);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
     public function get_surveillance_pagination($page) {
        
        $query = $this->db->get('tblsurveillance', 1, $page);
        return $query->result_array();
    }


/////////////////////////////////////////////////////////////////////////////////////
}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

