<?php

class M_user extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblCountries Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $username = '';
    var $photo = '';
    var $date_add = '';
    var $levels_idlevels = '';
    var $password = '';
    var $status = '';

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tblCountries .
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

    public function set_users($data) {
        $this->username = $data['d_username'];
        $this->photo = $data['d_photo'];
        //$this->date_add = $data['d_date_add']; 
        $this->date_add = date("Y-m-d H:i:s");
        $this->levels_idlevels = $data['d_levels'];
        $this->password = $data['d_password'];
        $this->status = $data['d_status'];

        $resultado = $this->db->insert('users', $this);
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_users($data) {
        $this->db->set('photo', $data['d_photo']);
//        $this->db->set('date_add', $data['d_date_add']);
        $this->db->set('levels_idlevels', $data['d_levels']);
        $this->db->set('password', $data['d_password']);
        $this->db->set('status', $data['d_status']);
        $this->db->where('username', $data['d_username']);

        $this->db->update('users');
    }

    ////// leo/////
    function update_users_sin($data) {
        $this->db->set('photo', $data['d_photo']);
        //$this->db->set('date_add', $data['d_date_add']);
        $this->db->set('levels_idlevels', $data['d_levels']);
        $this->db->set('status', $data['d_status']);
        $this->db->where('username', $data['d_username']);
        $this->db->update('users');
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_users($username) {
        $this->db->delete('users', array('username' => $username));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla por nombre

    public function find_users($data) {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->like('levels_idlevels', $data['d_levels']);
        $this->db->like('status', $data['d_status']);
        $this->db->like('username', $data['d_username']);
        $this->db->like('date_add', $data['d_date_add']);


        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un elemento solicitado.

    public function get_one_users($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de todos los elementos.

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

