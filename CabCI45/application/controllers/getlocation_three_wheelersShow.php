<?php

class getlocation_three_wheelersShow extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('../controllers/pages');
    }
    
    public function index(){
        $this->pages->view('getlocation_three_wheelers');
    }
    
}

