<?php

class driver_model extends CI_Model 
{
    /**
     * get driver details 
     * @return type
     */
    function getDriverD()
    {
        $this->db->select("*");
        $this->db->from('driver');
        $query = $this->db->get();
        
        return $query->result();
    }
    /**
     * edit driver details of a particulardriver
     * @param type $a(NIC of the selected driver)
     * @return type
     */
    function edit($a)
    {
        $query = $this->db->get_where('driver', array('NIC' => $a))->row();
        return $query;
    }
    
    /**
     * update divers' details
     * @param type $data
     * @param type $nic
     * @return boolean
     */
    function update($data,$nic)
    {   
        $this->db->where('NIC',$nic);
        $this->db->set($data);
        $this->db->update('driver');
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }

    /**
     * get drivers who has more than 10 comments
     * posted by divers
     * @return type
     */
    function getComments()
    {
        $data   =   array(
                'comments.Driver_Name', 
                'comments.b_status',
                'driver.status');

        $this->db->select($data);
        $this->db->from('comments','driver');
        $this->db->join('driver',"comments.Driver_Name = (CONCAT(driver.FName,' ',driver.LName))");
        $this->db->group_by('comments.Driver_Name'); 
        $this->db->having('count(comments.Driver_Name) > 10');
        $query = $this->db->get();
        
        return $query->result_array();        
    }
    
    /**
     * get all the comments
     * @return type
     */
    function get_all_Comments()
    {
        $this->db->select("*");
        $this->db->from('comments');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * block drivers
     * @param type $data
     * @param type $name
     * @return boolean
     */
    function blockDrivers($data,$name)
    {
        $array = array('FName' => $name[0], 'LName' => $name[1]);
        $this->db->where($array);
        $this->db->set($data);
        $this->db->update('driver');
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
    /**
     * get details of the calls
     * @return type
     */
    function getCalls()
    {
        $this->db->select("*");
        $this->db->from('calls');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
}

?>
