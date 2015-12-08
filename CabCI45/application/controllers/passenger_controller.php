<?php  
   
class passenger_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('passenger_model'); 
        $this->load->library('../controllers/pages');
    }
       
    public function index() 
    {
        $this->data['dt'] = $this->passenger_model->getPassengerD(); 
        $this->pages->view('Passenger_View', $this->data); 
    }

}  
 
?>  
