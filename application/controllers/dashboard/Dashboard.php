<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends My_Controller {

    var $header_view, $footer_view, $data_template = array(), $use_acc = array();

    function __construct() {

        parent::__construct();

        $this->load->helper('my_uri');
        $this->load->library('Form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('M_dashboard', 'M_tbldistricts'));


        //new authentication method
        $this->auth->route_access();

    }

    function index() {

        $data['title'] = 'Dashboard';
        $data['accesos'] = $this->result_f_access;
        $data['parish'] = $this->M_tbldistricts->get_all_Districts();
        $data['mapItems'] = $this->fillMapItems($this->M_dashboard->getMapData());
        $data['pag'] = 'Dashboard';
        $this->data_template['script'] = $this->load->view('pages/s_dashboard', NULL, TRUE);

        $this->render('pages/dashboard_view', 'template_any', $this->data_template, $this->header_view, $data, $this->footer_view);

    }

    function fillMapItems($mapItems) {

        $itemsStr = '[';

        foreach ($mapItems as $item) {


            switch ($item['region']) {
                case "KN-06":
                    $itemsStr .= '{
                    groupId: "John",
                    imageURL:"' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: 8,
                    longitude: -62.777,
                    width: 45,
                    height: 45,
                    title: "Farmers:' . $item['Farmer'] . ' "
                }, {
                    groupId: "John",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: 3,
                    longitude: -62.79,
                    width: 45,
                    height: 45,
                    title: "Farms:' . $item['Farm'] . ' "
                }, {
                    groupId: "John",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: 5,
                    longitude: -62.76,
                    width: 45,
                    height: 45,
                    title: "Livestock:' . $item['Animal'] . ' "
                }, {
                    groupId: "John",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -1,
                    longitude: -62.77,
                    width: 45,
                    height: 45,
                    title: "Illness Cases:' . $item['IllnesCase'] . ' "
                },';
                    break;
                case "KN-01":
                    $itemsStr .= '{
                    groupId: "Christchurch",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -2,
                    longitude: -62.733,
                    width: 45,
                    height: 45,
                    title: "Farmers:' . $item['Farmer'] . ' "
                }, {
                    groupId: "Christchurch",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -7,
                    longitude: -62.748,
                    width: 45,
                    height: 45,
                    title: "Farms:' . $item['Farm'] . ' "
                }, {
                    groupId: "Christchurch",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -9,
                    longitude: -62.725,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Christchurch",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -14,
                    longitude: -62.738,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                },';

                    break;
                case "KN-08":
                    $itemsStr .= '{
                    groupId: "Mary",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -9,
                    longitude: -62.704,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Mary",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -14,
                    longitude: -62.715,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Mary",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -12,
                    longitude: -62.687,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Mary",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -18,
                    longitude: -62.697,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                }, ';
                    break;
                case "KN-11":
                    $itemsStr .= '{
                    groupId: "Peter",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -23,
                    longitude: -62.677,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Peter",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -26,
                    longitude: -62.688,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Peter",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -25,
                    longitude: -62.660,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Peter",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -30,
                    longitude: -62.67,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                },';

                    break;
                case "KN-03":
                    $itemsStr .= '{
                    groupId: "George",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -40,
                    longitude: -62.646,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "George",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -35,
                    longitude: -62.692,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "George",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -55,
                    longitude: -62.56,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "George",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -57.5,
                    longitude: -62.581,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                },';
                    break;
                case "KN-09":
                    $itemsStr .= '{
                    groupId: "Paul",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: 12,
                    longitude: -62.826,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Paul",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: 7,
                    longitude: -62.84,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Paul",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: 7,
                    longitude: -62.815,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Paul",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: 2,
                    longitude: -62.825,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                }, ';
                    break;
                case "KN-02":
                    $itemsStr .= '{
                    groupId: "Anne",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -2,
                    longitude: -62.836,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Anne",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -5,
                    longitude: -62.85,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Anne",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -7,
                    longitude: -62.825,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Anne",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -12,
                    longitude: -62.835,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                },';
                    break;
                case "KN-13":
                    $itemsStr .= '{
                    groupId: "Thomas",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -13,
                    longitude: -62.79,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Thomas",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -16,
                    longitude: -62.81,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Thomas",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -18,
                    longitude: -62.775,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Thomas",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -23,
                    longitude: -62.793,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                },';
                    break;
                case "KN-15":
                    $itemsStr .= '{
                    groupId: "Trinity",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farmer.png",
                    latitude: -26,
                    longitude: -62.73,
                    width: 45,
                    height: 45,
                    title: "Farmers: ' . $item['Farmer'] . ' "
                }, {
                    groupId: "Trinity",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/farm.png",
                    latitude: -29,
                    longitude: -62.75,
                    width: 45,
                    height: 45,
                    title: "Farms: ' . $item['Farm'] . ' "
                }, {
                    groupId: "Trinity",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/cow.png",
                    latitude: -31,
                    longitude: -62.725,
                    width: 45,
                    height: 45,
                    title: "Livestock: ' . $item['Animal'] . ' "
                }, {
                    groupId: "Trinity",
                    imageURL: "' . base_url() . '/assets/img/farm_icons/syringe.png",
                    latitude: -34,
                    longitude: -62.74,
                    width: 45,
                    height: 45,
                    title: "Illness Cases: ' . $item['IllnesCase'] . ' "
                }';
                    break;
            }
        }
        $itemsStr .= ']';
        return $itemsStr;

    }

    function animalByDistricts() {
        echo json_encode($this->M_dashboard->getAnimalByDistricts());

    }

    function caseByDistricts() {
        echo json_encode($this->M_dashboard->getCaseByDistricts());

    }

    function farmByDistricts() {
        echo json_encode($this->M_dashboard->getFarmByDistricts());

    }

    function totalAnimalTestedByFarm() {
        echo json_encode($this->M_dashboard->getTotalAnimalTestedByFarm());

    }

    function numberOfAnimalImportedBySpecies() {
        echo json_encode($this->M_dashboard->getNumberOfAnimalImportedBySpecies());

    }

    function totaloMeatImportedByCommodity() {
        echo json_encode($this->M_dashboard->getTotaloMeatImportedByCommodity());

    }

    function numberSpecimenPermitIssuedByYear() {
        echo json_encode($this->M_dashboard->getNumberSpecimenPermitIssuedByYear());

    }

}
