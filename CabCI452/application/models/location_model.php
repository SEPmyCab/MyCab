<?php

class location_model extends CI_Model 
{
    public function getLoc() 
    {
        $this->db->select('location.Location_Id,driver.NIC,location.Vehicle_ID,location.Latitude,location.Longitude');
        $this->db->from('location');
        $this->db->join('driver', 'driver.Location_Id = location.Location_Id');
        
        $query = $this->db->get();

        return $query->result(); 
    }

}

?>