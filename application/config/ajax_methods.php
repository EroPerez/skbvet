<?php

defined('BASEPATH') or die('No direct script access.');

$config['ajax_methods'] = array(
//  'my_controller_name' => TRUE, //all methods must be ajax
  'Dashboard' => array(
    'animalByDistricts' => TRUE,
    'caseByDistricts' => TRUE,
    'farmByDistricts' => TRUE,
    'totalAnimalTestedByFarm' => TRUE,
    'numberOfAnimalImportedBySpecies' => TRUE,
    'totaloMeatImportedByCommodity' => TRUE,
    'numberSpecimenPermitIssuedByYear' => TRUE,
  ),
  'Farm' => array(
    'farmer_forward' => TRUE,
    'farmer_backward' => TRUE,
    'farm_delete' => TRUE,
    'farm_add_edit' => TRUE,
    'farmer_search' => TRUE,
    'farmer_get_by_id' => TRUE,
    'breeds_species' => TRUE,
    'listar_livestock' => TRUE,
    'listar_livestock_transf' => TRUE,
    'delete_livestock' => TRUE,
    'add_livestock' => TRUE,
    'edit_livestock' => TRUE,
    'illness_livestock' => TRUE,
  )
);

