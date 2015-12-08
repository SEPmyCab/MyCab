<?php

class getlocation_van_noncertifiedShow extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('../controllers/pages');
    }
    
    public function index(){
        $this->pages->view('getlocation_van_noncertified');
    }
    
}

