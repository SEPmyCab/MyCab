<?php  
   
class send_promotional_emails_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('send_promotional_emails_model'); 
        $this->load->library('../controllers/pages');
    }
    
    /**
     * load passenger details to the view
     */
    public function index() 
    {
        $this->data['dt'] = $this->send_promotional_emails_model->getPassengerD(); 
        $this->pages->view('send_promotional_emails_view', $this->data); 
    }
    
    /**
     * sending emails
     */
    function sendEmail()
    {
    
        if ($this->input->post('btn_promo'))
        {
            $to=$this->input->post('recipients');
            $subject=$this->input->post('subject');
            $body=$this->input->post('body');
            
            if(empty($to)||empty($subject)||empty($body)){
                
                echo "<script>
                    alert('All Fields Required!!');
                    window.location.href='send_promotional_emails_controller';
                    </script>"; 
                
            }
            else{
                
                $CI =& get_instance();

                $CI->load->library('email');               

                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'smtp.mailgun.org';
                $config['smtp_port'] = 587;
                $config['smtp_user'] = 'postmaster@sandboxf9d48201d3744125aa9850e51a156f2f.mailgun.org';
                $config['smtp_pass'] = 'a3532c63a43d55f68b8dc6f881d2008e';

                $CI->email->initialize($config);
                $CI->email->from('sep014wd@gmail.com', 'My Cab');
                $CI->email->to($to);
                $CI->email->subject($subject);
                $CI->email->message($body);

                $CI->email->send();

                echo "<script>
                alert('Email Sucessfully Sent');
                window.location.href='send_promotional_emails_controller';
                </script>"; 
                
            }

        }
        else {
            echo 'Cannot Setup Mail';
        }


    }
 }  

 
?>  
