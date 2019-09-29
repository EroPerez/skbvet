<?php

class M_tradeliveanimals extends CI_Model {

///////////////////////////////////////////////////////////////////////////////////// 
//Tabla tblTradeLiveAnimals Atributos //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

    var $recn = '';
    var $tradeType = '';
    var $dateOfLicence = '';
    var $licenceNo = '';
    var $fee = '';
    var $FarmRecn = ''; //OJO puede estar cambiado

/////////////////////////////////////////////////////////////////////////////////////     
// M�todos de la clase tbltradeliveanimals.
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

    public function set_tradeliveanimals($data) {
        //$this->recn = $data['d_recn'];   
        $this->tradeType = $data['d_tradeType'];
        $this->dateOfLicence = $data['d_dateOfLicence'];
        $this->licenceNo = $data['d_licenceNo'];
        $this->fee = $data['d_fee'];
        $this->FarmRecn = $data['d_FarmRecn'];

        $this->db->insert('tbltradeliveanimals', $this);
        return $this->db->insert_id();
    }

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// 
// Esta funci�n actualiza un elemento en la tabla.

    function update_tradeliveanimals($data) {
        $this->recn = $data['d_recn'];
        $this->tradeType = $data['d_tradeType'];
        $this->dateOfLicence = $data['d_dateOfLicence'];
        $this->licenceNo = $data['d_licenceNo'];
        $this->fee = $data['d_fee'];
        $this->FarmRecn = $data['d_FarmRecn'];

        $this->db->where('recn', $data['d_recn']);
        $resultado = $this->db->update('tbltradeliveanimals', $this);
        return $this->recn;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n elimina un elemento en la tabla.

    public function del_tradeliveanimals($id) {
        $resultado = $this->db->delete('tbltradeliveanimals', array('recn' => $id));
        return $resultado;
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////   
// Esta funci�n busca elementos en la tabla que cumplen con un criterio.

    public function find_tradeliveanimals($data) {
        $this->db->select('tbltradeLiveanimals.*');
        $this->db->from('tbltradeliveanimals');
        $this->db->where('tradeType', $data['d_tradeType']);
        $this->db->like('licenceNo', $data['d_licenceNo']);
        //$this->db->like('FarmRecn', $data['d_FarmRecn']);

        $query = $this->db->get();
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeliveanimals() {
        $query = $this->db->get('tbltradeliveanimals');
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla.

    public function get_tradeliveanimals_impexp($impexp) {
        $query = $this->db->get_where('tbltradeliveanimals', array('tradeType' => $impexp));
        return $query->result_array();
    }

///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de un art�culo solicitado.

    public function get_a_tradeliveanimals($id) {
        $query = $this->db->get_where('tbltradeliveanimals', array('recn' => $id));
        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes (Quarterly Animal Imported)

    public function get_quarterly_number_of_animal_imported_by_species($start_quarter, $species = null) {


        $this->db->select("CONCAT(tblspecies.name,' : ', tblbreeds.name)  AS species,  SUM(tbltradeliveanimalsdetails.quantity) AS `Total number of animal`", FALSE);
        $this->db->from('tblspecies');
        $this->db->join('tblbreeds', 'tblspecies.recn = tblbreeds.speciesrecn');
        $this->db->join('tbltradeliveanimalsdetails', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tbltradeliveanimals', 'tbltradeliveanimals.recn = tbltradeliveanimalsdetails.tradeLiveAnimalRecn');
        $this->db->where('tbltradeliveanimals.tradeType = 1');
        $this->db->where("tbltradeliveanimals.dateOfLicence BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");
        $this->db->group_by('tblspecies.name');

        if ($species) {
            $this->db->having('tblspecies.name', $species);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////
/// Los Reportes (Yearly Animal Imported)

    public function get_yearly_number_of_animal_imported_by_species($year, $species = null) {


        $this->db->select("CONCAT(tblspecies.name,' : ', tblbreeds.name)  AS species,  SUM(tbltradeliveanimalsdetails.quantity) AS `Total number of animal`", FALSE);
        $this->db->from('tblspecies');
        $this->db->join('tblbreeds', 'tblspecies.recn = tblbreeds.speciesrecn');
        $this->db->join('tbltradeliveanimalsdetails', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tbltradeliveanimals', 'tbltradeliveanimals.recn = tbltradeliveanimalsdetails.tradeLiveAnimalRecn');
        $this->db->where('tbltradeliveanimals.tradeType = 1');
        $this->db->where("YEAR(tbltradeliveanimals.dateOfLicence)", $year);
        $this->db->group_by('tblspecies.name');
        echo $this->db->last_query();
        if ($species) {
            $this->db->having('tblspecies.name', $species);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////   
//    Report for Export(live Animals Quartely) 
    public function get_quarter_liveanimals_export_licences($start_quarter) {
        $this->db->distinct();
        $this->db->select("tblcountries.name AS `Country/Address of destination`,
       'St. Kitts and Nevis' as 'Country/Address of origin',
       tbltradeliveanimalsdetails.consignee_of_sender AS `Consignee of sender`,
       tbltradeliveanimalsdetails.consignee_of_receiver AS
        `Consignee of receiver`,
       CONCAT(tblbreeds.name, ' : ', tblspecies.name) AS `ID of Animals`", FALSE);
        $this->db->from('tbltradeliveanimals');
        $this->db->join('tbltradeliveanimalsdetails', 'tbltradeliveanimalsdetails.tradeLiveAnimalRecn = tbltradeliveanimals.recn');
        $this->db->join('tblcountries', 'tbltradeliveanimalsdetails.country = tblcountries.recn');
        $this->db->join('tblbreeds', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tblspecies', 'tblbreeds.speciesrecn = tblspecies.recn');

        $this->db->where('tbltradeliveanimals.tradeType = 2');
        $this->db->where("tbltradeliveanimals.dateOfLicence BETWEEN '" . $start_quarter . "' AND  DATE_ADD( '" . $start_quarter . "', INTERVAL 1 QUARTER)");

        $query = $this->db->get();
//        echo $this->db->last_query();

        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
    /////////////////////////////////////////////////////////////////////////////////////   
//    Report for Export(live Animals Quartely) 
    public function get_yearly_liveanimals_export_licences($year) {
        $this->db->distinct();
        $this->db->select("tblcountries.name AS `Country/Address of destination`,
       'St. Kitts and Nevis'       as 'Country/Address of origin',
       tbltradeliveanimalsdetails.consignee_of_sender AS `Consignee of sender`,
       tbltradeliveanimalsdetails.consignee_of_receiver AS
        `Consignee of receiver`,
       CONCAT(tblbreeds.name, ' : ', tblspecies.name) AS `ID of Animals`", FALSE);
        $this->db->from('tbltradeliveanimals');
        $this->db->join('tbltradeliveanimalsdetails', 'tbltradeliveanimalsdetails.tradeLiveAnimalRecn = tbltradeliveanimals.recn');
        $this->db->join('tblcountries', 'tbltradeliveanimalsdetails.country = tblcountries.recn');
        $this->db->join('tblbreeds', 'tbltradeliveanimalsdetails.breedRecn = tblbreeds.recn');
        $this->db->join('tblspecies', 'tblbreeds.speciesrecn = tblspecies.recn');

        $this->db->where('tbltradeliveanimals.tradeType = 2');
        $this->db->where("YEAR(tbltradeliveanimals.dateOfLicence)", $year);

        $query = $this->db->get();
//        echo $this->db->last_query();

        return $query->result_array();
    }

    ///////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////
/// Retorna todos los datos de la tabla paginados.

    public function get_tradeliveanimals_pagination($page, $tradeType) {
        $this->db->where(array('tradeType' => $tradeType));
        $query = $this->db->get('tbltradeliveanimals', 1, $page);
        return $query->result_array();
    }

/////////////////////////////////////////////////////////////////////////////////////
}

//llave de la clase  
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

