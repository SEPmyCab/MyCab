<?php

session_start();

Class User_Authentication extends CI_Controller {

public function __construct() {
parent::__construct();


$this->load->helper('form');


$this->load->library('form_validation');


$this->load->library('session');


$this->load->model('user_model');
$this->load->library('../controllers/pages');

}


public function forgot_pwd_show() {
$this->pages->view('email_check');
}

//public function user_registration_show() {
//$this->load->view('registration_form');
//}


public function new_user_registration() {


//$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('inputEmail', 'Email', 'trim|required|xss_clean');
$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|xss_clean');
$this->form_validation->set_rules('inputPasswordCon', 'Confirm Password', 'trim|required|xss_clean');
if ($this->form_validation->run() == FALSE) {
$this->load->view('register');
} else {
    if($this->input->post('inputPassword')==$this->input->post('inputPasswordCon'))
    {
$data = array(
//'name' => $this->input->post('name'),
//'user_name' => $this->input->post('username'),
'Email' => $this->input->post('inputEmail'),
'Password' => $this->input->post('inputPassword')
);
$result = $this->user_model->registration_insert($data) ;
if ($result == TRUE) {
$data['message_display'] = 'Registration Successfull!';
$this->pages->view('register', $data);
} else {
$data['message_display'] = 'Username already exist!';
$this->pages->view('register',$data);
}
}
 else {
    $data['message_display'] = 'Passwords do not match!';
$this->pages->view('register', $data);
}
}

}


public function user_login_process() {

$this->form_validation->set_rules('inputEmaillogin', 'Email', 'trim|required|xss_clean');
$this->form_validation->set_rules('inputPasswordlogin', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
$this->pages->view('login');
} else {
   //checkCookies();
    //checkSession();
$data = array(
'Email' => $this->input->post('inputEmaillogin'),
'Password' => $this->input->post('inputPasswordlogin')
);
$result = $this->user_model->login($data);
if($result == TRUE){
$sess_array = array(
'email' => $this->input->post('inputEmaillogin')

);
$result = $this->user_model->read_user_information($sess_array);
if($result != false){

$sess_array = array(
'email' => $result[0]->Email,
'fname' => $result[0]->FName,
'login'=>true
);
$this->session->set_userdata('logged_in', $sess_array);
//redirect($this->uri->uri_string());
//$this->load->view('pages/home', $data);
if($this->session->userdata['logged_in']['email']=='a@gmail.com')
{
    $this->pages->view('adminMain');
}
else{
 redirect($this->pages->view('home'));
}
}
}else{
$data = array(
'error_message' => 'Invalid Username or Password'
);
$this->pages->view('login',$data);
}
}
}

public function logout() {

$sess_array = array(
'email' => '',
'fname'=>''
);
$this->session->unset_userdata('logged_in', $sess_array);
setcookie("user", "", time()-3600);
$data['message_display'] = 'Successfully Logout';
redirect($this->pages->view('home'));
}
}

function setCookies($user) {
        setcookie("user", $user, time()+3600);
    }
 
   
    function checkCookies() {
        if(isset($_COOKIE)) {
            if(isset($_COOKIE['user'])) {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $_COOKIE['user'];
            }
        }
    }
 
    
    function checkSession() {
        
        if(isset($_SESSION['login'])) {
            
           $this->pages->view('home');
        }
    }
