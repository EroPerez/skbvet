<?php
class M_rabiescertificate extends CI_Model 
{
		
///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblRabiesCertificate Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

		var $recn = '';
		var $LabNo = '';   
		var $Destination = ''; 
		var $Hospital = ''; 
		var $VetName = ''; 
		var $VetAddress = ''; 
		var $VetCity = '';
		var $VetState = ''; 
		var $Owner = '';   
		var $OwnerStreet = ''; 
		var $OwnerCity = ''; 
		var $OwnerCountry = ''; 
		var $AnimalName = ''; 
		var $Species = '';
		var $Colour = '';
		var $VaccHistory = ''; 
		var $Titer = ''; 
		var $VetPhone = ''; 
		var $VetFax = ''; 
		var $VetZip = '';
		var $OwnerZip = '';
		var $MicroChipNo = ''; 
		var $Sex = ''; 
		var $VaccRoute = ''; 
		var $CertDate = ''; 
		var $AnimalDOB = '';
		var $DateReceived = '';
		var $SerumDate = '';
		var $AnimalRecn = ''; //llave externa
			
/////////////////////////////////////////////////////////////////////////////////////     
// Métodos de la clase RabiesCertificate.
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

public function set_rabiescertificate($data)
    {     
        //$this->recn = $data['d_recn'];   
        $this->LabNo = $data['d_LabNo'];   
        $this->Destination = $data['d_Destination'];
        $this->Hospital = $data['d_Hospital'];  
        $this->VetName = $data['d_VetName'];
        $this->VetAddress = $data['d_VetAddress']; 
		$this->VetCity = $data['d_VetCity'];
        $this->VetState = $data['d_VetState']; 
		$this->Document = $data['d_Document'];   
        $this->Owner = $data['d_Owner'];
        $this->OwnerStreet = $data['d_OwnerStreet'];  
        $this->OwnerCity = $data['d_OwnerCity'];
        $this->OwnerCountry = $data['d_OwnerCountry']; 
		$this->AnimalName = $data['d_AnimalName'];
        $this->Species = $data['d_Species']; 
		$this->Colour = $data['d_Colour'];   
        $this->VaccHistory = $data['d_VaccHistory'];
        $this->Titer = $data['d_Titer'];  
        $this->VetPhone = $data['d_VetPhone'];
        $this->VetFax = $data['d_VetFax']; 
		$this->VetZip = $data['d_VetZip'];
        $this->OwnerZip = $data['d_OwnerZip']; 
		$this->MicroChipNo = $data['d_MicroChipNo']; 
		$this->sex = $data['d_sex'];   
        $this->VaccRoute = $data['d_VaccRoute'];
        $this->CertDate = $data['d_CertDater'];  
        $this->AnimalDOB = $data['d_AnimalDOB'];
        $this->DateReceived = $data['d_DateReceived']; 
		$this->SerumDate = $data['d_SerumDate'];
        $this->AnimalRecn = $data['d_AnimalRecn']; 
        
        $resultado = $this->db->insert('tblrabiescertificate',$this); 
    }

/////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////// 
// Esta función actualiza un elemento en la tabla.
    
function update_rabiescertificate($data)
    { 
        $this->recn = $data['d_recn'];   
        $this->LabNo = $data['d_LabNo'];   
        $this->Destination = $data['d_Destination'];
        $this->Hospital = $data['d_Hospital'];  
        $this->VetName = $data['d_VetName'];
        $this->VetAddress = $data['d_VetAddress']; 
		$this->VetCity = $data['d_VetCity'];
        $this->VetState = $data['d_VetState']; 
		$this->Document = $data['d_Document'];   
        $this->Owner = $data['d_Owner'];
        $this->OwnerStreet = $data['d_OwnerStreet'];  
        $this->OwnerCity = $data['d_OwnerCity'];
        $this->OwnerCountry = $data['d_OwnerCountry']; 
		$this->AnimalName = $data['d_AnimalName'];
        $this->Species = $data['d_Species']; 
		$this->Colour = $data['d_Colour'];   
        $this->VaccHistory = $data['d_VaccHistory'];
        $this->Titer = $data['d_Titer'];  
        $this->VetPhone = $data['d_VetPhone'];
        $this->VetFax = $data['d_VetFax']; 
		$this->VetZip = $data['d_VetZip'];
        $this->OwnerZip = $data['d_OwnerZip']; 
		$this->MicroChipNo = $data['d_MicroChipNo']; 
		$this->sex = $data['d_sex'];   
        $this->VaccRoute = $data['d_VaccRoute'];
        $this->CertDate = $data['d_CertDater'];  
        $this->AnimalDOB = $data['d_AnimalDOB'];
        $this->DateReceived = $data['d_DateReceived']; 
		$this->SerumDate = $data['d_SerumDate'];
        $this->AnimalRecn = $data['d_AnimalRecn'];
        
        $this->db->where('recn', $data['d_recn']);
        $this->db->update('tblrabiescertificate',$this); 
    }
    
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función elimina un elemento en la tabla.

public function del_rabiescertificate($id)
    {
     $this->db->delete('tblrabiescertificate', array('recn' => $id));
    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////   
// Esta función busca elementos en la tabla que cumplen con un criterio.

public function find_rabiescertificate($data)
    {
     $this->db->select('tblrabiescertificate.*');
     $this->db->from('tblrabiescertificate');
     $this->db->like('LabNo', $data['d_LabNo']);
     //$this->db->like('DateAdded', $data['d_DateAdded']);
	 //$this->db->like('DateEntered', $data['d_DateEntered']);
        
     $query = $this->db->get();    
     return $query->result_array();     
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

public function get_rabiescertificate()
	{
		$query = $this->db->get('tblrabiescertificate');
		return $query->result_array();     
	}
///////////////////////////////////////////////////////////////////////////////////// 

	/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un artículo solicitado.

public function get_a_rabiescertificate($id)
	{
		$query = $this->db->get_where('tblrabiescertificate', array('recn' => $id));
		return $query->result_array();     
	}
/////////////////////////////////////////////////////////////////////////////////////


}  //llave de la clase 
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

