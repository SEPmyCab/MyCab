<?php
function sendEmail($to=0,$rs=0)
{
    $CI =& get_instance();

        $CI->load->library('email');               
       
  $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = 465;
            $config['smtp_user'] = 'sep014wd@gmail.com';
            $config['smtp_pass'] = 'sep_14_cab';

            
            
          $CI->email->initialize($config);
           $CI->email->from('sep014wd@gmail.com', 'My Cab');
            $CI->email->to($email);
           $CI->email->subject('Get your forgotten Password');
           $CI->email->message('Please go to this link to get your password.
       http://localhost/CabCI/get_password/index/' . $rs);

           $CI->email->send();
            echo "Please check your Email.";
}