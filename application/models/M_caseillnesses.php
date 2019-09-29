<?php

class M_caseillnesses extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblCaseIllnesses Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $caseRecn = '';  //llave externa 
    var $illnessRecn = ''; //llave externa
    var $dateOfIllness = '';
    var $summary = '';
    var $treatmentRecn = ''; //llave externa
    var $dateOfTreatment = '';
    var $response = '';
    var $Withdrawal = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase CaseIllnesses.
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

    public function set_caseillnesses($data) {
        //$this->recn = $data['d_recn'];   
        $this->caseRecn = $data['d_caseRecn'];
        $this->illnessRecn = $data['d_illnessRecn'];
        $this->dateOfIllness = $data['d_dateOfIllness'];
        $this->summary = $data['d_summary'];
        $this->treatmentRecn = $data['d_treatmentRecn'];
        $this->dateOfTreatment = $data['d_dateOfTreatment'];
        $this->response = $data['d_response'];
        $this->Withdrawal = $data['d_Withdrawal'];

        return $this->db->insert('tblcaseillnesses', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_caseillnesses($data) {
        $this->recn = $data['d_recn'];
        $this->caseRecn = $data['d_caseRecn'];
        $this->illnessRecn = $data['d_illnessRecn'];
        $this->dateOfIllness = $data['d_dateOfIllness'];
        $this->summary = $data['d_summary'];
        $this->treatmentRecn = $data['d_treatmentRecn'];
        $this->dateOfTreatment = $data['d_dateOfTreatment'];
        $this->response = $data['d_response'];
        $this->Withdrawal = $data['d_Withdrawal'];

        $this->db->where('recn', $data['d_recn']);
        return $this->db->update('tblcaseillnesses', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_caseillnesses_by($caseRecn) {
        return $this->db->delete('tblcaseillnesses', array('caseRecn' => $caseRecn));
    }

    /////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_caseillnesses($id) {
        return $this->db->delete('tblcaseillnesses', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_caseillnesses($data) {
        $this->db->select('tblcaseIllnesses.*');
        $this->db->from('tblcaseillnesses');
        $this->db->like('caseRecn', $data['d_caseRecn']);
        $this->db->like('dateOfIllness', $data['d_dateOfIllness']);
        $this->db->like('dateOfTreatment', $data['d_dateOfTreatment']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_caseillnesses() {
        $query = $this->db->get('tblcaseillnesses');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un caso en raw solicitado.

    public function get_caseillnesses_by_id($id) {
        $query = $this->db->get_where('tblcaseillnesses', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_caseillnesses($idIllness) {
        $this->db->select('tblcaseillnesses.*, tblillnessnames.name as nameillness , tblillnessnames.recn as recnillness, tbltreatmentnames.name as treatname,tbltreatmentnames.recn as recntreatname');
        //$this->db->from('tblcaseillnesses');
        $this->db->join('tblillnessnames', 'tblcaseillnesses.illnessRecn = tblillnessnames.recn');
        $this->db->join('tbltreatmentnames', 'tblcaseillnesses.treatmentRecn = tbltreatmentnames.recn');
        $query = $this->db->get_where('tblcaseillnesses', array('tblcaseillnesses.recn' => $idIllness));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los illness de un case.

    public function get_illness_by_case($idcase) {
        $this->db->select('tblcaseillnesses.* ,tblillnessnames.name as nameillness ,tbltreatmentnames.name as treatname');
        // $this->db->from('tblcaseillnesses');
        $this->db->join('tblillnessnames', 'tblcaseillnesses.illnessRecn = tblillnessnames.recn');
        $this->db->join('tbltreatmentnames', 'tblcaseillnesses.treatmentRecn = tbltreatmentnames.recn');
        $query = $this->db->get_where('tblcaseillnesses', array('tblcaseillnesses.caseRecn' => $idcase));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Withdrawal Period Report

    public function get_animal_in_withdrawal_period() {
        $this->db->select("tbllivestock.IDNO AS `Id of Animal`, CONCAT(tblfarmers.fName, ' ', tblfarmers.lName) AS `name of farmer`, tblcaseillnesses.Withdrawal - TIMESTAMPDIFF(DAY, DATE(tblcaseillnesses.dateOfTreatment), CURDATE()) AS `time left(Withdrawal)`", FALSE);
        $this->db->from('tblcasedetails');
        $this->db->join('tblcaseillnesses', 'tblcasedetails.recn = tblcaseillnesses.caseRecn');
        $this->db->join('tblfarmers', 'tblcasedetails.farmRecn = tblfarmers.recn');
        $this->db->join('tbllivestock', 'tblcasedetails.livestockRecn = tbllivestock.recn');

        $this->db->where('TIMESTAMPDIFF(DAY, DATE(tblcaseillnesses.dateOfTreatment), CURDATE()) < tblcaseillnesses.Withdrawal');
        $query = $this->db->get();
        return $query->result_array();
    }

}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

