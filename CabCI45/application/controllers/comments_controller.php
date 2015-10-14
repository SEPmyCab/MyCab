<?php

class comments_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('comments_model');
        $this->load->library('../controllers/pages');
        $this->load->database();
    }
    
    public function index() 
    {
        $this->data['dt'] = $this->comments_model->getComments();
        $this->pages->view('Comments', $this->data); 
    }
    
    /**
     * load drivers' names
    */
    public function loaddata()
    {
        $this->data['names'] = $this->comments_model->getNames(); 
        $this->pages->view('Comments', $this->data);
    }
   
    /**
     * add comments of the passengers
     */
    public function addComments() 
    {
        if ($this->input->post('btnpost'))
        {
            $data = array(
            'Email' => $this->input->post('txtmail'),
            'Driver_Name' => $this->input->post('dname'),
            'Comment' => $this->input->post('txtcomment'),
            'b_status' => $this->input->post('txtblock'),
            );
            
                if ($this->comments_model->save($data)) 
                {
                  echo 
                        "<script>
                        alert('Comments Posted Successfully');
                        window.location.href='comments_controller';
                        </script>";
                }
                else
                {
                    $data=array('error_message' => 'An error occurred. Please try again later');
                    $this->pages->view('err',$data);
                }
        }
        
        else 
        {
            echo 'Cannot retrieve values';
        }
    }

}

