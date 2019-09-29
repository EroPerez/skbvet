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

        $resultado = $this->db->insert('tblCaseIllnesses', $this);
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
        $this->db->update('tblCaseIllnesses', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_caseillnesses($id) {
        $this->db->delete('tblCaseIllnesses', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_caseillnesses($data) {
        $this->db->select('tblCaseIllnesses.*');
        $this->db->from('tblCaseIllnesses');
        $this->db->like('caseRecn', $data['d_caseRecn']);
        $this->db->like('dateOfIllness', $data['d_dateOfIllness']);
        $this->db->like('dateOfTreatment', $data['d_dateOfTreatment']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_caseillnesses() {
        $query = $this->db->get('tblCaseIllnesses');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_caseillnesses($id) {
        $query = $this->db->get_where('tblCaseIllnesses', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

