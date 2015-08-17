<?php

class driver_model extends CI_Model 
{
    function getDriverD()
    {
        $this->db->select("*");
        $this->db->from('driver');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function edit($a)
    {
        $query = $this->db->get_where('driver', array('NIC' => $a))->row();
        return $query;
    }
    
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
     
//    function delete($a)
//    {
//        $query = $this->db->delete('driver', array('NIC' => $a));
//        return $query;
//    }
    
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
    
    function get_all_Comments()
    {
        $this->db->select("*");
        $this->db->from('comments');
        $query = $this->db->get();
        
        return $query->result();
    }
    
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
    
}

?>
