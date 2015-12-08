<?php

class reserve_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('reservation_model');
        $this->load->library('../controllers/pages');
        $this->load->database();
    }
 
    public function index() 
    {
        $this->pages->view('reserve_Cab'); 
    }
    
    /**
     * add details of the reservations 
     */
    public function addReservation() 
    {
        if ($this->input->post('btnBook'))
        {
            $data = array(
            'passenger' => $this->session->userdata['logged_in']['email'],
            'pickup_loc' => $this->input->post('pickup_from'),
            'drop_loc' => $this->input->post('GoingTo'),
            'pickup_date_time' => $this->input->post('date_time'),
            'phone' => $this->input->post('txtphone'),
            'vehicle_type' => $this->input->post('vtype'),
            'AC' => $this->input->post('AC'),
            'purpose' => $this->input->post('purpose')
            );
            
                if ($this->reservation_model->save($data)) 
                {
                    echo 
                        "<script>
                        alert('Vehicle Reserved');
                        window.location.href='reserve_controller';
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
            echo 'Cannot add values';
        }
    }
    
    /**
     * get all reservation details
     */
    public function getAllReservations() 
    { 
        $this->data['dt'] = $this->reservation_model->getReservations();
        $this->pages->view('reservations_View', $this->data); 
    }
    
    /**
     * get NIC of the available drivers 
     * of the selected vehicle type
     * @param type $type
     */
    public function getDriver($type,$rid) 
    {
        $this->data['driver'] = $this->reservation_model->getCab_driver($type,$rid);
        $this->pages->view('reservations_notif', $this->data);
    }  
    
    /**
     * get the phone number of the driver
     * @param type $nic
     */
    public function getDriver_phone($nic) 
    {
        $this->data['NIC'] = $this->reservation_model->getDriverPhone($nic);
        $this->pages->view('reservations_notif', $this->data);
    }
    
    /**
     * get the details of a hire
     * to send a notification to a driver
     */
    public function getHireDetails()
    { 
        if(isset($_POST['msg']))
        {
            $Data = $_POST['msg'];
            $rid = $Data[1];
            $nic_dname = $Data[2];
            $phone = $Data[3];
        }
        
        $arr = str_split($nic_dname,10);
        $driverNIC = $arr[0];
       
        $result = $this->reservation_model->getReservationbyid($rid);
       
        $passenger = $result[0]->passenger;
        $picup = $result[0]->pickup_loc;
        $picoff = $result[0]->drop_loc;
        $time =  $result[0]->pickup_date_time;
        
        $driverID = $this->reservation_model->getDriverbyID($driverNIC);
        $driverPhoneID = $driverID[0]->Reg_id;
	
        //sending notification to driver
        $gcmRegID  = $driverPhoneID;
        $pushMessage = "Passenger name - $passenger. \nPick up from -".$picup."\nDrop off at-".$picoff."\nDate and Time-".$time;
        
        echo $pushMessage;
          
        if (isset($gcmRegID) && isset($pushMessage)) 
        {        
            $gcmRegIds = array($gcmRegID);
            $message = array("m" => $pushMessage);  
            $pushStatus = sendMessageThroughGCM($gcmRegIds, $message);
           
            echo "\n\n";
            echo 'Notification Sent !!!';
        }
        
        $data = array(
            'reserved_id' => $rid,
            'driverNIC' => $driverNIC,
            'status' => 1
            );
        
        $this->reservation_model->allocateDriver($data);
    }
    
}

    /**
     * send notification message
     * @param type $registatoin_ids
     * @param type $message
     * @return type
     */
    function sendMessageThroughGCM($registatoin_ids, $message) 
    {
        //Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
       
        // Update your Google Cloud Messaging API Key
        define("GOOGLE_API_KEY", "AIzaSyAGPvU-g3sjabqUrW-0XeY65DTpkQcaoQY");     
        
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
         
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
        if ($result === FALSE) 
        {
            die('Curl failed: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        return $result;
    }

?>

