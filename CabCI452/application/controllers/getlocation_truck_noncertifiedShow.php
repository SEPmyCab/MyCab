<?php

class getlocation_truck_noncertifiedShow extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('../controllers/pages');
    }
    
    public function index(){
        $this->pages->view('getlocation_truck_noncertified');
    }
    
}

