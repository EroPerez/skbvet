<?php
class M_abbatoir extends CI_Model 
{
		
///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblAbatoir Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

		var $recn = '';
		var $sDate = '';   
		var $Presenter = ''; 
		var $PresenterAdr = '';
		var $PresenterPhone = '';  
		var $User = '';
		var $DateEntered = ''; 
			
/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase Abbatoir.
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

public function set_abbatoir($data)
    {     
        //$this->recn = $data['d_recn'];   
        $this->sDate = $data['d_sDate'];   
        $this->Presenter = $data['d_Presenter'];
        $this->PresenterAdr = $data['d_PresenterAdr'];  
        $this->PresenterPhone = $data['d_PresenterPhone'];
       // $this->ScanLocation = $data['d_ScanLocation']; 
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered']; 
        
        $resultado = $this->db->insert('tblabbatoir',$this); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.
    
function update_abbatoir($data)
    { 
        $this->recn = $data['d_recn'];   
        $this->sDate = $data['d_sDate'];   
        $this->Presenter = $data['d_Presenter'];
        $this->PresenterAdr = $data['d_PresenterAdr'];  
        $this->PresenterPhone = $data['d_PresenterPhone'];
        $this->ScanLocation = $data['d_ScanLocation']; 
		$this->User = $data['d_User'];
        $this->DateEntered = $data['d_DateEntered'];
        
        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblabbatoir',$this); 
    }
    
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

public function del_abbatoir($id)
    {
     $this->db->delete('tblabbatoir', array('recn' => $id));
    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

public function find_abbatoir($data)
    {
     $this->db->select('tblAbbatoir.*');
     $this->db->from('tblabbatoir');
     $this->db->like('sDate', $data['d_sDate']);
	 $this->db->like('DateEntered', $data['d_DateEntered']);
        
     $query = $this->db->get();    
     return $query->result_array();     
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

public function get_abbatoir()
	{
		$query = $this->db->get('tblabbatoir');
		return $query->result_array();     
	}
///////////////////////////////////////////////////////////////////////////////////// 

	/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

public function get_a_abbatoir($id)
	{
		$query = $this->db->get_where('tblabbatoir', array('recn' => $id));
		return $query->result_array();     
	}
/////////////////////////////////////////////////////////////////////////////////////


}  //llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

