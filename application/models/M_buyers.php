<?php
class M_buyers extends CI_Model 
{
		
///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblBuyers Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

		var $recn = '';
		var $Name = '';   
		var $BuyerAdr = ''; 
		var $BuyerPhone = ''; //llave externa
		var $User = '';
		var $DateEntered = ''; 
			
/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase Buyers.
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
/// Esta funci�n inserta un elemento en la tabla.

public function set_buyers($data)
    {     
        //$this->recn = $data['d_recn'];   
        $this->Name = $data['d_Name'];   
        $this->BuyerAdr = $data['d_BuyerAdr'];
        $this->BuyerPhone = $data['d_BuyerPhone'];  
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered']; 
        
        $resultado = $this->db->insert('tblbuyers',$this); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.
    
function update_buyers($data)
    { 
        $this->recn = $data['d_recn'];   
        $this->Name = $data['d_Name'];   
        $this->BuyerAdr = $data['d_BuyerAdr'];
        $this->BuyerPhone = $data['d_BuyerPhone'];  
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered']; 
        
        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblbuyers',$this); 
    }
    
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

public function del_buyers($id)
    {
     $this->db->delete('tblbuyers', array('recn' => $id));
    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

public function find_buyers($data)
    {
     $this->db->select('tblbuyers.*');
     $this->db->from('tblbuyers');
     $this->db->like('Name', $data['d_Name']);
     $this->db->like('BuyerAdr', $data['d_BuyerAdr']);
	 $this->db->like('DateEntered', $data['d_DateEntered']);
        
     $query = $this->db->get();    
     return $query->result_array();     
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

public function get_buyers()
	{
		$query = $this->db->get('tblbuyers');
		return $query->result_array();     
	}
///////////////////////////////////////////////////////////////////////////////////// 

	/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

public function get_a_buyers($id)
	{
		$query = $this->db->get_where('tblbuyers', array('recn' => $id));
		return $query->result_array();     
	}
/////////////////////////////////////////////////////////////////////////////////////


}  //llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

