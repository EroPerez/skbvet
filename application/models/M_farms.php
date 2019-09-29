<?php

class M_farms extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblFarms Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $farmName = '';
    var $location = '';
    var $districtRecn = '';    // llave externa
    var $size = '';
    var $sizeUnits = '';
    var $farmerRecn = ''; //  llave externa

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tblFarms.
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

    public function set_farms($data) {
        //$this->recn = $data['d_recn'];   
        $this->farmName = $data['d_farmName'];
        $this->location = $data['d_location'];
        $this->districtRecn = $data['d_districtRecn'];
        $this->size = $data['d_size'];
        $this->sizeUnits = $data['d_sizeUnits'];
        $this->farmerRecn = $data['d_farmerRecn'];

        $this->db->insert('tblfarms', $this);
        return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_farms($data) {
        $this->recn = $data['d_recn'];
        $this->farmName = $data['d_farmName'];
        $this->location = $data['d_location'];
        $this->districtRecn = $data['d_districtRecn'];
        $this->size = $data['d_size'];
        $this->sizeUnits = $data['d_sizeUnits'];
        $this->farmerRecn = $data['d_farmerRecn'];

        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblfarms', $this);
        return $this->recn;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_farms($id) {
        return $this->db->delete('tblfarms', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_farms($data) {
        $this->db->select('tblfarms.*');
        $this->db->from('tblfarms');
        $this->db->like('farmName', $data['d_farmName']);
        $this->db->like('location', $data['d_location']);

        $query = $this->db->get();
        return $query->result_array();
    }

    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_farms() {
        $query = $this->db->get('tblfarms');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_farms($id) {
        $query = $this->db->get_where('tblfarms', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
    /// Retorna todos los farms de un farmer

    public function get_farms_by_farmer($id) {
        $this->db->select('*');
        $this->db->from('tblfarms');
        $this->db->where('farmerRecn', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

}

//llave de la clase  
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

