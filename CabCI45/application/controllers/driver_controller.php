<?php  
   
class driver_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('driver_model');
        $this->load->library('../controllers/pages');
        $this->load->database();
    }
       
    public function index() 
    {
        $this->data['dt'] = $this->driver_model->getDriverD(); 
        $this->pages->view('Driver_View', $this->data); 
    }
    
    /**
     *  edit driver details
     */
    public function edit()
    {
        $nic = $this->uri->segment(3);   
        $dt = $this->driver_model->edit($nic);
        
        $data['nic'] =$dt->NIC;
        $data['email'] =$dt->Email;
        $data['certif'] =$dt->Certification;
        $data['status'] =$dt->status;
        
        $this->pages->view('editDriver_View',$data);
    }
 
    /**
     *  update driver details
     */
    public function update()
    {
        if ($this->input->post('btnsubmit')) 
        {
            $data = array(
                'Email' => $this->input->post('txtmail'),
                'Certification' => $this->input->post('txtcertif'),
                'status' => $this->input->post('txtstat')
                 );
        }
 
        else 
        {
            echo 'Cannot retrieve values';
        }
        
        $nic = $this->input->post('txtnic');

        if ($this->driver_model->update($data,$nic)) 
	{
             echo 
            "<script>
            alert('Successfully updated');
            window.location.href='driver_controller';
            </script>";
	}
	else
	{
            $data=array('error_message' => 'An error occurred. Please try again later');
            $this->pages->view('err',$data);
        }
    }
    
    /**
     * get status and the posted comments
     */
    public function comments() 
    {
        $this->data['dt1'] = $this->driver_model->getComments();
        $this->data['dt2'] = $this->driver_model->get_all_Comments();
        $this->pages->view('Block_View', $this->data);
    }
    
    /**
     * block the reported drivers
     */
    public function block()
    {
        $data = array(
                'Password' => 'admin123',
                'status' => 'BLOCKED'
                 );
        
        $nameurl = $this->uri->segment(3);
        $full_name=str_replace("%20"," ",$nameurl);
        
        $name = explode(" ",$full_name);
        
        if ($this->driver_model->blockDrivers($data,$name))
        {
            redirect('driver_controller');
        }
        
        else 
        {
            $data=array('error_message' => 'An error occurred. Please try again later');
            $this->pages->view('err',$data);
        }
    }
    
    /**
     * get details of the calls(date,time,passenger)
     */
    public function calls() 
    {
        $this->data['dt1'] = $this->driver_model->getCalls();
        $this->pages->view('calls_log_View', $this->data);
    }
  
}
  
?>  
