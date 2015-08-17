<?php

class get_forgot_pwd extends CI_Controller {

    

    function __construct() {
        parent::__construct();
        // $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('user_model');
        
        $this->load->library('../controllers/pages');

    }

    public function index() {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');

        if ($this->form_validation->run() == FALSE) {
           $data = array(
'error_message' => 'Please enter a valid Email Address'
);
$this->pages->view('email_check',$data);
        } else {
            $email = $this->input->post('email');
if($this->func_email_check($email)==TRUE)
{
            $this->load->helper('string');
            $rs = random_string('alnum', 12);

            $data = array(
                'Email' => $email,
                'rs' => $rs
            );
            $this->user_model->update_random_string($data);

            $config['protocol'] = 'smtp';
            $config['_smtp_auth']   = TRUE;
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
           // $config['smtp_host'] = 'localhost';
            $config['smtp_crypto']='ssl';
            $config['smtp_port'] = 465;
            // $config['smtp_port'] = 25;
            $config['smtp_user'] = 'sep014wd@gmail.com';
            $config['smtp_pass'] = 'sep_14_cab';
           // $config['protocol'] = 'mail';
            //$config['mailpath'] = '/usr/sbin/sendmail';
            //$config['charset'] = 'iso-8859-1';
            //$config['wordwrap'] = TRUE;
            
          
           
            
           

$CI =& get_instance();
            
           $CI->load->library('email');
            $CI->email->initialize($config);
            $CI->email->from('sep014wd@gmail.com', 'My Cab');
            $CI->email->to($email);
           $CI->email->subject('Get your forgotten Password');
            $CI->email->message('Please go to this link to get your password.
       http://localhost/CabCI/get_password/index/' . $rs);

            
            if ($CI->email->send()) {
        echo 'Please check your email';
    } 
    else {
        show_error($CI->email->print_debugger());
    }
        }
        }
    }

    public function func_email_check($str) {
        $result = $this->user_model->check_email_exist($str);

        if ($result) {
            return true;
        } else {
          // $this->form_validation->set_message('email_check','This Email does not exist.');
         $data = array(
'error_message' => 'This email does not exist'
);
$this->pages->view('email_check',$data);
            return false;
        }
    }

}
