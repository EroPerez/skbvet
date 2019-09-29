<?php
class M_abbatoirlivestock extends CI_Model 
{
		
///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblAbatoirLivestock Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

		var $recn = '';
		var $LivestockID = '';   
		var $LivestockRecn = ''; // llave externa 
		var $AbbatoirRecn = ''; // llave externa
		var $Type = '';  
		var $Buyer = '';
		var $User = '';
		var $DateEntered= ''; 
			
/////////////////////////////////////////////////////////////////////////////////////     
// Métodos de la clase Abbatoirlivestock.
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

public function set_abbatoirlivestock($data)
    {     
        //$this->recn = $data['d_recn'];   
        $this->LivestockID = $data['d_LivestockID'];   
        $this->LivestockRecn = $data['d_LivestockRecn'];
        $this->AbbatoirRecn = $data['d_AbbatoirRecn'];  
        $this->Type = $data['d_Type'];
        $this->Buyer = $data['d_Buyer']; 
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered']; 
        
        $resultado = $this->db->insert('tblabatoirlivestock',$this); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////// 
// Esta función actualiza un elemento en la tabla.
    
function update_abbatoirlivestock($data)
    { 
        $this->recn = $data['d_recn'];   
        $this->LivestockID = $data['d_LivestockID'];   
        $this->LivestockRecn = $data['d_LivestockRecn'];
        $this->AbbatoirRecn = $data['d_AbbatoirRecn'];  
        $this->Type = $data['d_Type'];
        $this->Buyer = $data['d_Buyer']; 
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered']; 
        
        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblabatoirlivestock',$this); 
    }
    
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función elimina un elemento en la tabla.

public function del_abbatoirlivestock($id)
    {
     $this->db->delete('tblabatoirlivestock', array('recn' => $id));
    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función busca elementos en la tabla que cumplen con un criterio.

public function find_abbatoirlivestock($data)
    {
     $this->db->select('tblabatoirlivestock.*');
     $this->db->from('tblabatoirlivestock');
     $this->db->like('LivestockID', $data['d_LivestockID']);
	 $this->db->like('DateEntered', $data['d_DateEntered']);
        
     $query = $this->db->get();    
     return $query->result_array();     
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

public function get_abbatoirlivestock()
	{
		$query = $this->db->get('tblabatoirlivestock');
		return $query->result_array();     
	}
///////////////////////////////////////////////////////////////////////////////////// 

	/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un artículo solicitado.

public function get_a_abbatoirlivestock($id)
	{
		$query = $this->db->get_where('tblabatoirlivestock', array('recn' => $id));
		return $query->result_array();     
	}
/////////////////////////////////////////////////////////////////////////////////////


}  //llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

