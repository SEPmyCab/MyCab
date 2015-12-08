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
        $this->data['dt1'] = $this->driver_model->getDriverAvbSch();
        $this->data['dt2'] = $this->driver_model->getDriverHireSch();
        $this->data['dt_nic'] = $this->driver_model->getNIC(); 
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
            $data=array('error_message' => 'Fields are not updated. Update the fields !!!');
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
        $this->pages->view('Calls_Log_View', $this->data);
    }
   
    /**
     * add avaiability details of the drivers
     */
    public function addAvb() 
    {
        if ($this->input->post('btnSave'))
        {
            $mon_from = "";
            $mon_to = "";
            $tue_from = "";
            $tue_to = "";
            $wed_from = "";
            $wed_to = "";
            $thu_from = "";
            $thu_to = "";
            $fri_from = "";
            $fri_to = "";
            $sat_from = "";
            $sat_to = "";
            $sun_from = "";
            $sun_to = "";
            
            if (isset($_POST['chk_mon'])) {
               $mon_from = $this->input->post('from_time1');
               $mon_to = $this->input->post('to_time1');
            }
            if (isset($_POST['chk_tue'])) {
                $tue_from = $this->input->post('from_time2');
                $tue_to = $this->input->post('to_time2');
            }
            if (isset($_POST['chk_wedn'])) {
                $wed_from = $this->input->post('from_time3');
                $wed_to = $this->input->post('to_time3');
            }
            if (isset($_POST['chk_thu'])) {
                $thu_from = $this->input->post('from_time4');
                $thu_to = $this->input->post('to_time4');
            }
            if (isset($_POST['chk_fri'])) {
                $fri_from = $this->input->post('from_time5');
                $fri_to = $this->input->post('to_time5');
            }
            if (isset($_POST['chk_sat'])) {
                $sat_from = $this->input->post('from_time6');
                $sat_to = $this->input->post('to_time6');
            }
            if (isset($_POST['chk_sun'])) {
                $sun_from = $this->input->post('from_time7');
                $sun_to = $this->input->post('to_time7');
            }
            
            $nic = $this->input->post('nic');
            $arr = explode(" ", $nic);
            
            $data = array(
            'driver_NIC' => $arr[0],
            'Monday_from' => $mon_from,
            'Monday_to' => $mon_to,
            'Tuesday_from' => $tue_from,
            'Tuesday_to' => $tue_to,
            'Wednesday_from' => $wed_from,
            'Wednesday_to' => $wed_to,
            'Thursday_from' => $thu_from,
            'Thursday_to' => $thu_to,
            'Friday_from' => $fri_from,
            'Friday_to' => $fri_to,
            'Saturday_from' =>  $sat_from ,
            'Saturday_to' => $sat_to,
            'Sunday_from' => $sun_from,
            'Sunday_to' => $sun_to
            );
            
            if ($this->driver_model->saveAvbSchedule($data)) 
            {
                echo 
                    "<script>
                    alert('Availability details saved');
                    window.location.href='driver_controller';
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
    
    /**
     *  edit avaiability details of the drivers
     */
    public function editAvb()
    {
        $aid = $this->uri->segment(3);   
        $dt = $this->driver_model->editAvb($aid);
        
        $data['nic'] =$dt->driver_NIC;
        $data['mf'] = $dt->Monday_from;
        $data['mt'] = $dt->Monday_to;
        $data['tf'] = $dt->Tuesday_from;
        $data['tt'] = $dt->Tuesday_to;
        $data['wf'] = $dt->Wednesday_from;
        $data['wt'] = $dt->Wednesday_to;
        $data['thf'] = $dt->Thursday_from;
        $data['tht'] = $dt->Thursday_to;
        $data['ff'] = $dt->Friday_from;
        $data['ft'] = $dt->Friday_to;
        $data['sf'] = $dt->Saturday_from;
        $data['st'] = $dt->Saturday_to;
        $data['suf'] = $dt->Sunday_from;
        $data['sut'] = $dt->Sunday_to;
        
        $this->pages->view('editDriverAvb_View',$data);
    }
    
    /**
     *  update avaiability details of the drivers
     */
    public function updateAvb()
    {
        if ($this->input->post('btnUpdate')) 
        {
            $data = array(
            'driver_NIC' => $this->input->post('nic'),
            'Monday_from' => $this->input->post('from_time1'),
            'Monday_to' => $this->input->post('to_time1'),
            'Tuesday_from' => $this->input->post('from_time2'),
            'Tuesday_to' => $this->input->post('to_time2'),
            'Wednesday_from' => $this->input->post('from_time3'),
            'Wednesday_to' => $this->input->post('to_time3'),
            'Thursday_from' => $this->input->post('from_time4'),
            'Thursday_to' => $this->input->post('to_time4'),
            'Friday_from' => $this->input->post('from_time5'),
            'Friday_to' => $this->input->post('to_time5'),
            'Saturday_from' =>  $this->input->post('from_time6'),
            'Saturday_to' => $this->input->post('to_time6'),
            'Sunday_from' => $this->input->post('from_time7'),
            'Sunday_to' => $this->input->post('to_time7')
            );
        }
        
        else 
        {
            echo 'Cannot retrieve values';
        }
        
        $id = $this->input->post('id');
       
        if ($this->driver_model->updateAvb($data,$id)) 
	{
             echo 
            "<script>
            alert('Successfully updated');
            window.location.href='driver_controller';
            </script>";
	}
	else
	{
            $data=array('error_message' => 'Fields are not updated. Update the fields !!!');
            $this->pages->view('err',$data);
        }
    }
  
}
  
?>  
