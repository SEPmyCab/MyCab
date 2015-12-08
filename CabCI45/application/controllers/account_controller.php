<?php

class account_controller extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('account_model');
               $this->load->library('../controllers/pages');
              
	}
        function showAccount(){
            
         
           $data=$this->account_model->getData($this->session->userdata['logged_in']['email']);
              $this->pages->view('account',$data);
           
            
        }
        
                function index()
	{			
		$this->form_validation->set_rules('email', 'Email', '');			
		$this->form_validation->set_rules('first_name', 'First Name', '');			
		$this->form_validation->set_rules('last_name', 'Last Name', '');			
		$this->form_validation->set_rules('phone_number', 'Phone Number', '');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('pages/account');
		}
		else 
		{
		 	
			
			$form_data = array(
					       	'Email' => $this->session->userdata['logged_in']['email'],
					       //	'FName' => set_value('first_name'),
					      // 	'LName' => set_value('last_name'),
					      // 	'Phone_No' => set_value('phone_number')
                            'FName'=>$this->input->post('first_name'),
                            'LName'=>$this->input->post('last_name'),
                            'Phone_No'=>$this->input->post('phone_number')
						);
					
			
		
			if ($this->account_model->SaveForm($form_data) == TRUE) 
			{
				//redirect('account_controller/success');   
			
                            $data = array(
                            'error_message' => 'Your changes have been saved!!'
                                );
                            $this->pages->view('acc_err',$data);
                        }
			else
			{
                            $data = array(
                            'error_message' => 'An error occurred saving your information. Please try again later'
                                );
                            $this->pages->view('acc_err',$data);
			//echo 'An error occurred saving your information. Please try again later';
                        
			
			}
		}
	}
	function success()
	{
			echo 'Your changes have been saved!!';
	}
}
?>