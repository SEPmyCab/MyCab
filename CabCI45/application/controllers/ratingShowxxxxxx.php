<?php

class ratingShow extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('../controllers/pages');
    }
    
    public function index(){
        $this->pages->view('rating');
    }
    
}