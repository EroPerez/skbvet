<?php

/*
  `recn` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `sender` varchar(60) DEFAULT NULL,
  `reciever` varchar(60) DEFAULT NULL,
  `destination` varchar(60) DEFAULT NULL,
  `weight` float(9,3) unsigned DEFAULT NULL,
  `dateIssued` date DEFAULT NULL,
  `fee` float(9,3) unsigned DEFAULT NULL,
 * */

class M_specimenpermit extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblsurveillance Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $name = '';
    var $sender = '';
    var $reciever = '';
    var $destination = '';
    var $weight = 0.0;
    var $fee = 0.0;
    var $dateIssued = '';

/////////////////////////////////////////////////////////////////////////////////////     
// Metodos de la clase specimenpermit.
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

    public function set_specimenpermit($data) {
        //$this->recn = $data['d_recn'];   
        $this->name = $data['d_name'];
        $this->sender = $data['d_sender'];
        $this->reciever = $data['d_reciever'];
        $this->destination = $data['d_destination'];
        $this->weight = $data['d_weight'];
        $this->fee = $data['d_fee'];
        $this->dateIssued = $data['d_dateIssued'];

        $this->db->insert('tblspecimenpermit', $this);
        return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_specimenpermit($data) {
        $this->recn = $data['d_recn'];
        $this->name = $data['d_name'];
        $this->sender = $data['d_sender'];
        $this->reciever = $data['d_reciever'];
        $this->destination = $data['d_destination'];
        $this->weight = $data['d_weight'];
        $this->fee = $data['d_fee'];
        $this->dateIssued = $data['d_dateIssued'];

        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblspecimenpermit', $this);
        return $this->recn;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_specimenpermit($id) {
        return $this->db->delete('tblspecimenpermit', array('recn' => $id));
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_specimenpermit($data) {
        $this->db->select('tblspecimenpermit.*');
        $this->db->from('tblspecimenpermit');

        $this->db->like('name', $data['d_name']);
        $this->db->or_like('sender', $data['d_sender']);
        $this->db->or_like('reciever', $data['d_reciever']);
        $this->db->or_like('destination', $data['d_destination']);
        $this->db->or_like('weight', $data['d_weight']);
        $this->db->or_like('fee', $data['d_fee']);
        $this->db->or_like('dateIssued', $data['d_dateIssued']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_specimenpermit() {
        $query = $this->db->get('tblspecimenpermit');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_specimenpermit($id) {
        $query = $this->db->get_where('tblspecimenpermit', array('recn' => $id));
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Number of Biological Specimen Permit Issued yearly

    public function get_yearly_number_of_specimenpermit($year) {

        $this->db->select('tblspecimenpermit.recn');
        $this->db->from('tblspecimenpermit');
        $this->db->where('YEAR(tblspecimenpermit.dateIssued)', $year);

        $query = $this->db->get();
        return array('Number of Biological Specimen' => $query->num_rows());
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Number of Biological Specimen Permit Issued quarterly

    public function get_quarterly_number_of_specimenpermit($start_quarter) {
        $this->db->select('tblspecimenpermit.recn');
        $this->db->from('tblspecimenpermit');

        $this->db->where("tblspecimenpermit.dateIssued BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");
        $query = $this->db->get();
        return array('Number of Biological Specimen' => $query->num_rows());
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla paginados.

    public function get_specimenpermit_pagination($page) {
        $query = $this->db->get('tblspecimenpermit', 1, $page);
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

//llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

