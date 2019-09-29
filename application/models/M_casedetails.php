<?php

class M_casedetails extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblCaseDetails Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $caseNumber = '';
    var $dateOfCase = '';
    var $farmRecn = ''; //llave externa
    var $livestockRecn = '';
    var $vetRecn = ''; //llave externa
    var $billTotal = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase CaseDetails.
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

    public function set_casedetails($data) {
        //$this->recn = $data['d_recn'];   
        $this->caseNumber = $data['d_caseNumber'];
        $this->dateOfCase = $data['d_dateOfCase'];
        $this->farmRecn = $data['d_farmRecn'];
        $this->livestockRecn = $data['d_livestockRecn'];
        $this->vetRecn = $data['d_vetRecn'];
        $this->billTotal = $data['d_billTotal'];
        $this->db->insert('tblcasedetails', $this);
        return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_casedetails($data) {
        $this->recn = $data['d_recn'];
        $this->caseNumber = $data['d_caseNumber'];
        $this->dateOfCase = $data['d_dateOfCase'];
        $this->farmRecn = $data['d_farmRecn'];
        $this->livestockRecn = $data['d_livestockRecn'];
        $this->vetRecn = $data['d_vetRecn'];
        $this->billTotal = $data['d_billTotal'];

        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblcasedetails', $this);
        return $this->recn; 
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_casedetails($id) {
        return $this->db->delete('tblcasedetails', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_casedetails($data) {
        $this->db->select('tblcasedetails.*');
        $this->db->from('tblcasedetails');
        if (isset($data['d_caseNumber']) && isset($data['d_dateOfCase'])) {
            $this->db->like('caseNumber', $data['d_caseNumber']);
            $this->db->or_like('dateOfCase', $data['d_dateOfCase']);
        }

        if (isset($data['d_livestockRecn'])) {
            $this->db->like('livestockRecn', $data['d_livestockRecn']);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_casedetails() {
        $query = $this->db->get('tblcasedetails');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_casedetails($id) {
        $query = $this->db->get_where('tblcasedetails', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los bill de un case.
    public function get_bill_by_case($idcase) {

        $this->db->select('tblfarm.name, tblveterinarians.name, tblcasedetails.*, tblbill.*');
        $this->db->from('tblbill');
        $this->db->join('tblcasedetails', 'tblcasedetails.recn = tblbill.caseRecn');
        $this->db->join('tblfarm', 'tblcasedetails.farmRecn = tblfarm.recn');
        $this->db->join('tblveterinarians', 'tblcasedetails.vetRecn = tblveterinarians.recn');
        $query = $this->db->get_where('tblbill', array('caseRecn' => $idcase));
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /// Reports on animal illness cases (Monthly)
    public function get_monthly_animal_illness_cases($month, $year) {
        $this->db->distinct();
        $this->db->select("tblcasedetails.caseNumber AS `case number`, tblillnessnames.name AS `name of illness`, viewlivestock.type_of_animal AS `type of animal`");
        $this->db->from('tblcaseillnesses');
        $this->db->join('tblillnessnames', 'tblcaseillnesses.illnessRecn = tblillnessnames.recn');
        $this->db->join('tblcasedetails', 'tblcasedetails.recn = tblcaseillnesses.caseRecn');
        $this->db->join('viewlivestock', 'tblcasedetails.livestockRecn = viewlivestock.recn');
        $this->db->where('MONTH(tblcasedetails.dateOfCase)', $month);
        $this->db->where('YEAR(tblcasedetails.dateOfCase)', $year);
        $this->db->order_by('tblcasedetails.caseNumber');
        $query = $this->db->get();

        $result = array();
        $result['rows'] = $query->result_array();
        $result['total number of cases'] = count($result['rows']);

        return $result;
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /// Reports on animal illness cases (Quarterly)
    public function get_quarterly_animal_illness_cases($start_quarter) {
        $this->db->distinct();
        $this->db->select("tblcasedetails.caseNumber AS `case number`, tblillnessnames.name AS `name of illness`, viewlivestock.type_of_animal AS `type of animal`");
        $this->db->from('tblcaseillnesses');
        $this->db->join('tblillnessnames', 'tblcaseillnesses.illnessRecn = tblillnessnames.recn');
        $this->db->join('tblcasedetails', 'tblcasedetails.recn = tblcaseillnesses.caseRecn');
        $this->db->join('viewlivestock', 'tblcasedetails.livestockRecn = viewlivestock.recn');
        $this->db->where("tblcasedetails.dateOfCase BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");
        $this->db->order_by('tblcasedetails.caseNumber');
        $query = $this->db->get();

        $result = array();
        $result['rows'] = $query->result_array();
        $result['total number of cases'] = count($result['rows']);

        return $result;
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /// Reports on animal illness cases (Yearly)
    public function get_yearly_animal_illness_cases($year) {
        $this->db->distinct();
        $this->db->select("tblcasedetails.caseNumber AS `case number`, tblillnessnames.name AS `name of illness`, viewlivestock.type_of_animal AS `type of animal`");
        $this->db->from('tblcaseillnesses');
        $this->db->join('tblillnessnames', 'tblcaseillnesses.illnessRecn = tblillnessnames.recn');
        $this->db->join('tblcasedetails', 'tblcasedetails.recn = tblcaseillnesses.caseRecn');
        $this->db->join('viewlivestock', 'tblcasedetails.livestockRecn = viewlivestock.recn');
        $this->db->where('YEAR(tblcasedetails.dateOfCase)', $year);
        $this->db->order_by('tblcasedetails.caseNumber');
        $query = $this->db->get();

        $result = array();
        $result['rows'] = $query->result_array();
        $result['total number of cases'] = count($result['rows']);

        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla paginados.

    public function get_casedetails_pagination($page) {

        $query = $this->db->get('tblcasedetails', 1, $page);
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los bill de un case.
    public function get_case_by_animal($id) {
        $this->db->order_by('`viewillnessbyanimal`.`dateOfIllness`', 'DESC');
        $query = $this->db->get_where('viewillnessbyanimal', array('livestockRecn' => $id));
        return $query->result_array();
    }

}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

