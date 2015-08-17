<?php

class admin_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->library('../controllers/pages');
    }
 
    public function index() 
    {
        $this->pages->view('adminMain'); 
    }
}

?>
