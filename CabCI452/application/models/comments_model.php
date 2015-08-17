<?php

class comments_model extends CI_Model 
{
    function getComments()
    {
        $this->db->select("*");
        $this->db->from('comments');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function getNames()
    {
        $this->db->select("CONCAT(FName, ' ', LName) AS full_name", FALSE);
        $this->db->from('driver');
        $this->db->order_by('LName', 'asc');
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function save($data)
    {
        $this->db->insert('comments', $data);
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
  
}

