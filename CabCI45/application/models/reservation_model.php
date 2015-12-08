<?php

class reservation_model extends CI_Model 
{
    /**
     * save reservation details
     * @param type $data
     * @return boolean
     */
    function save($data)
    {
        $this->db->insert('reserve_vehicle', $data);
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
    /**
     * get all reservation details
     * @return type
     */
    function getReservations()
    {
        $this->db->select("*");
        $this->db->from('reserve_vehicle');
        $this->db->where('reserve_vehicle.status',0);
        $this->db->order_by('pickup_date_time','asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get NIC of the available drivers 
     * according to the vehicle type
     * @param type $type
     * @return type
     */
    function getCab_driver($type,$rid)
    {
        $reservation_details = $this->getHireDetails($rid);
        $date = $reservation_details[0]->pickup_date_time;
        
        $timestamp = strtotime($date);
        $day = date('D', $timestamp);
        
        $reservation_time = date("H:i:s",strtotime($date));
      
        //get NIC of the drivers according to the vehicle type
        $this->db->select('distinct(vehicle.Driver_NIC)');
        $this->db->from('vehicle');
        $this->db->where('vehicle.Type',$type);
        $query1 = $this->db->get();
        $details = $query1->result(); 
        
        $arr = array();
        foreach($details as $i) 
        {
            array_push($arr, $i->Driver_NIC);
        }
         
        //get schedule details of the drivers
        $this->db->select('*');
        $this->db->from('driver_schedule');
        $this->db->where_in('driver_NIC', $arr);
        $query = $this->db->get();
        $resultArray = $query->result();
        
        $size = sizeof($resultArray);
        
        $to = null;
        $from = null; 
        
        $driverNICarray = array();
        
        for($i=0; $i<$size; $i++){
            
        if($day == 'Mon')
        {
            $from = $resultArray[$i]->Monday_from;
            $to = $resultArray[$i]->Monday_to;
        }
        else if($day == 'Tue') 
        {
            $from = $resultArray[$i]->Tuesday_from;
            $to = $resultArray[$i]->Tuesday_to;
        }
        else if($day == 'Wed') 
        {
            $from = $resultArray[$i]->Wednesday_from;
            $to = $resultArray[$i]->Wednesday_to;
        }
        else if($day == 'Thu') 
        {
            $from = $resultArray[$i]->Thursday_from;
            $to = $resultArray[$i]->Thursday_to;
        }
        else if($day == 'Fri') 
        {
            $from = $resultArray[$i]->Friday_from;
            $to = $resultArray[$i]->Friday_to;
        }
        else if($day == 'Sat') 
        {
            $from = $resultArray[$i]->Saturday_from;
            $to = $resultArray[$i]->Saturday_to;
        }
        else if($day == 'Sun') 
        {
            $from = $resultArray[$i]->Sunday_from;
            $to = $resultArray[$i]->Sunday_to;
        }
        
        if($reservation_time>$from && $to>$reservation_time){
           $driverDetails = $this->getDriverbyID($resultArray[$i]->driver_NIC);
           
           array_push($driverNICarray,$driverDetails);
        }
        
        }
        return $driverNICarray;
    }
  
    /**
     * get the phone number of the driver
     * @param type $nic
     * @return type
     */
    function getDriverPhone($nic)
    {
        $this->db->select('driver.Phone_No');
        $this->db->from('driver');
        $this->db->where('vehicle.NIC',$nic);
        $query = $this->db->get();
        
        return $query->result(); 
    }

    /**
     * get phone number
     * @param type $phone
     * @return type
     */
    function sendMessage($phone)
    {
        $this->db->select('driver.Phone_No');
        $this->db->from('driver');
        $this->db->where('vehicle.NIC',$nic);
        $query = $this->db->get();
        
        return $query->result(); 
    }
    
    /**
     * get all reservation details
     * @return type
     */
    function getHireDetails($rid)
    {
        $this->db->select("r.reserved_id, r.pickup_loc, r.drop_loc, r.pickup_date_time, r.phone, r.AC");
        $this->db->from('reserve_vehicle r');
        $this->db->where('r.reserved_id',$rid);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get reservation details according to the
     * reservation id
     * @param type $rid
     * @return type
     */
    function getReservationbyid($rid)
    {
        $this->db->select("*");
        $this->db->from('reserve_vehicle');
        $this->db->where('reserved_id',$rid);
        $this->db->order_by('pickup_date_time','asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    /**
     * get driver details
     * @param type $nic
     * @return type
     */
    function getDriverbyID($nic)
    {
        $this->db->select("*");
        $this->db->from('driver');
        $this->db->where('NIC',$nic);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * allocate drivers for hires
     * @param type $data
     * @return boolean
     */
    function allocateDriver($data)
    {
        $this->db->where('reserved_id',$data['reserved_id']);
        $this->db->set($data);
        $this->db->update('reserve_vehicle');
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return TRUE;
    }
}

