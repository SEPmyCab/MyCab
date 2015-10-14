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
        $this->db->order_by('pickup_date_time','asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get NIC of the available drivers 
     * of the selected vehicle type
     * @param type $type
     * @return type
     */
    function getCab_driver($type,$rid)
    {
        $this->db->select('vehicle.Driver_NIC');
        $this->db->from('vehicle');
        $this->db->join('location', 'location.Vehicle_ID = vehicle.Reg_No and location.Availability=1');
        $this->db->where('vehicle.Type',$type);
        
        $query = $this->db->get();

        return $query->result(); 
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
        $this->db->order_by('pickup_date_time','asc');
        $this->db->where('reserved_id',$rid);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    
       
     function getDriverbyID($nic)///////////////////////////////////////
    {
        
        
        $this->db->select("*");
        $this->db->from('driver');
        
        $this->db->where('NIC',$nic);
        $query = $this->db->get();
        
        return $query->result();
    }
}

