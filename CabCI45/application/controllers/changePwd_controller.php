<?php

class changePwd_controller extends CI_Controller {
               
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
        
                function index()
	{			
		$this->form_validation->set_rules('Curr_Pwd', 'Current Password', '');			
		$this->form_validation->set_rules('New_Pwd', 'New Password', '');			
		$this->form_validation->set_rules('Con_New_Pwd', 'New Password Confirm', '');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('pages/account');
		}
		else 
		{
                  $new1=  $this->input->post('New_Pwd');
                  $new2=  $this->input->post('Con_New_Pwd');
                  $email= $this->session->userdata['logged_in']['email'];
		 	if($new1==$new2)
                        {
			
			$form_data = array(
					       	'Password' =>$this->input->post('Curr_Pwd')
						);
			$result=$this->account_model->getPwd($email);
			$array = array(
                    'pwd' => $result[0]->Password
                                );
		
			if ($array['pwd'] == $form_data['Password']) 
			{
                            $data=array(
                                'Password'=>$new1
                            );
                            if($this->account_model->changePwd($data, $email)==TRUE){
                            //redirect('account_controller/success');
                                $data = array(
                            'error_message' => 'Your password have been changed!!'
                                );
                            $this->pages->view('acc_err',$data);
                                
                            }
                            
                                else {
			//echo 'An error occurred changing password. Please try again later';
                                    $data = array(
                            'error_message' => 'An error occurred changing password. Please try again later'
                                );
                            $this->pages->view('acc_err',$data);
                                }
			}
			else
			{
			//echo 'Your current password is incorrect';
                            $data = array(
                            'error_message' => 'Your current password is incorrect'
                                );
                            $this->pages->view('acc_err',$data);
			
			}
		}
                
                else{
                   // echo 'Please confirm new password!';
                       $data = array(
                            'error_message' => 'Please confirm new password!'
                                );
                            $this->pages->view('acc_err',$data);
                }
                }
	}
	function success()
	{
			echo 'Your changes have been saved!!';
	}
}
?>