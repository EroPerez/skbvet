<?php
class M_bills extends CI_Model 
{
		
///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblBills Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

		var $recn = '';
		var $caseRecn = '';  //llave externa 
		var $amount = ''; 
		var $type = ''; 
		var $balance = ''; 
		var $transactionDate = ''; 
			
/////////////////////////////////////////////////////////////////////////////////////     
// Métodos de la clase Bills.
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//Construtor de la clase.

public function __construct()
	{
	 parent::__construct();
	 $this->load->database(); 
	}
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
/// Esta función inserta un elemento en la tabla.

public function set_bills($data)
    {     
        //$this->recn = $data['d_recn'];   
        $this->caseRecn = $data['d_caseRecn'];   
        $this->amount = $data['d_amount'];
        $this->type = $data['d_type'];  
        $this->balance = $data['d_balance'];
        $this->transactionDate = $data['d_transactionDate']; 
        
        $resultado = $this->db->insert('tblbills',$this); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////// 
// Esta función actualiza un elemento en la tabla.
    
function update_bills($data)
    { 
        $this->recn = $data['d_recn'];   
        $this->caseRecn = $data['d_caseRecn'];   
        $this->amount = $data['d_amount'];
        $this->type = $data['d_type'];  
        $this->balance = $data['d_balance'];
        $this->transactionDate = $data['d_transactionDate'];   
        
        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblbills',$this); 
    }
    
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función elimina un elemento en la tabla.

public function del_bills($id)
    {
     $this->db->delete('tblbills', array('recn' => $id));
    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función busca elementos en la tabla que cumplen con un criterio.

public function find_bills($data)
    {
     $this->db->select('tblbills.*');
     $this->db->from('tblbills');
     $this->db->like('transactionDate', $data['d_transactionDate']);
     //$this->db->like('DateAdded', $data['d_DateAdded']);
	 //$this->db->like('DateEntered', $data['d_DateEntered']);
        
     $query = $this->db->get();    
     return $query->result_array();     
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

public function get_bills()
	{
		$query = $this->db->get('tblbills');
		return $query->result_array();     
	}
///////////////////////////////////////////////////////////////////////////////////// 

	/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un artículo solicitado.

public function get_a_bills($id)
	{
		$query = $this->db->get_where('tblbills', array('recn' => $id));
		return $query->result_array();     
	}
/////////////////////////////////////////////////////////////////////////////////////
public function get_bills_by_case($idcase,$modo) ///LEO
    {
        $this->db->select('tblbills.*');
        $this->db->order_by("transactionDate", $modo);
        //$this->db->from('tblbills');
        // $this->db->join('tblcaseillnesses', 'tblbills.caseRecn = tblcaseillnesses.recn' ); 
        // $this->db->join('tbltreatmentnames', 'tblcaseillnesses.treatmentRecn = tbltreatmentnames.recn' ); 
        $query = $this->db->get_where('tblbills', array('tblbills.caseRecn' => $idcase));
        return $query->result_array();     
    }
//////////////////////////////
}  //llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

