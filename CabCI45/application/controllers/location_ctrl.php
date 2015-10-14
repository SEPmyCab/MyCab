<?php

class location_ctrl extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('location_Model');
        $this->load->library('../controllers/pages');
        $this->load->database();
    }
    
    public function index() 
    {
        $this->data['dt'] = $this->location_Model->getLoc();
       
        $this->pages->view('location_View', $this->data); 
    }
  
}

?>
