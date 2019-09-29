<?php

class M_surveillancedetails extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblsurveillance Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
    //var $recn = '';
    var $livestockRecn = '';
    var $testResult = 'Positive';
    var $surveillanceRecn = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase Surveillancedetails.
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

    public function set_surveillancedetails($data) {
        //$this->recn = $data['d_recn'];   
        $this->livestockRecn = $data['livestockRecn'];
        $this->testResult = $data['testResult'];
        $this->surveillanceRecn = $data['surveillanceRecn'];


        $this->db->insert('tblsurveillancedetails', $this);
        return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_surveillancedetails($data) {
        $this->livestockRecn = $data['livestockRecn'];
        $this->testResult = $data['testResult'];
        $this->surveillanceRecn = $data['surveillanceRecn'];

        $this->db->where('recn', $data['recn']);
        $this->db->update('tblsurveillancedetails', $this);
        return $this->surveillanceRecn;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_surveillancedetails($id) {
        $query = $this->db->delete('tblsurveillancedetails', array('recn' => $id));
        return $query;
    }

    /////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_surveillancedetails_by($surveillanceRecn) {
        $query = $this->db->delete('tblsurveillancedetails', array('surveillanceRecn' => $surveillanceRecn));
        return $query;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_surveillancedetails($data) {
        $this->db->select('tblsurveillancedetails.*');
        $this->db->from('tblsurveillancedetails');
        $this->db->like('farmRecn', $data['d_farmRecn']);
        $this->db->like('testRecn', $data['d_testRecn']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_surveillancedetails() {
        $query = $this->db->get('tblsurveillancedetails');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_surveillancedetails($id) {
//        $query = $this->db->get_where('tblsurveillancedetails', array('recn' => $id));
//        return $query->result_array();

        $this->db->select("tblsurveillancedetails.*, tblsurveillance.testRecn, tblsurveillance.dateOfSurveillance,  tblsurveillance.farmRecn,  tblsurveillance.recn AS surveillanceRecn,   CONCAT(tblfarmers.fName, ' ', tblfarmers.lName) AS `name of farmer`,     tblfarms.farmName AS `name of farm`,     tbllivestock.IDNO AS `ID of animal`,  tbltestnames.name AS `test performed`,   tblsurveillancedetails.testResult as 'test result'");
        $this->db->from('tblsurveillancedetails');
        $this->db->join('tblsurveillance', 'tblsurveillancedetails.surveillanceRecn = tblsurveillance.recn');
        $this->db->join('tbllivestock', 'tblsurveillancedetails.livestockRecn = tbllivestock.recn');
        $this->db->join('tbltestnames', 'tblsurveillance.testRecn = tbltestnames.recn');
        $this->db->join('tblfarms', 'tblsurveillance.farmRecn = tblfarms.recn');
        $this->db->join('tblfarmers', 'tblfarms.farmerRecn = tblfarmers.recn');

        $this->db->where('tblsurveillancedetails.recn', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_surveillance_edit($id) {
        //$query = $this->db->get_where('tbltradeliveanimalsdetails', array('recn' => $id));
        //return $query->result_array(); 

        $this->db->select('tblsurveillancedetails.*');
        $this->db->from('tblsurveillancedetails');
        $this->db->where('tblsurveillancedetails.recn', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_a_surveillancedetails_by($farmRecn, $livestockRecn) {

        $this->db->select("tblsurveillancedetails.*, `tblsurveillance`.`farmRecn`, `tblsurveillancedetails.surveillanceRecn`");
        $this->db->from('tblsurveillancedetails');
        $this->db->join('tblsurveillance', 'tblsurveillancedetails.surveillanceRecn = tblsurveillance.recn','inner');        
        $this->db->where('tblsurveillance.farmRecn', $farmRecn);
        $this->db->where('tblsurveillancedetails.livestockRecn', $livestockRecn);
        $query = $this->db->get();
        return $query->result_array();
    }

}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

