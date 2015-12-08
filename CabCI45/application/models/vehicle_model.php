<?php

class vehicle_model extends CI_Model 
{
    /**
     * edit vehicle details
     * @param type $rNo
     * @return type
     */
    function edit($rNo)
    {
        $query = $this->db->get_where('vehicle_reg', array('reg_No' => $rNo))->row();
        return $query;
    }
    
    /**
     * update vehicle details
     * @param type $data
     * @param type $nic
     * @return boolean
     */
    function update($data,$rNo)
    {   
        $this->db->where('reg_No',$rNo);
        $this->db->set($data);
        $this->db->update('vehicle_reg');
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
    /**
     * delete vehicle
     * @param type $rNo
     * @return type
     */
    function delete($rNo)
    {
        $query = $this->db->delete('vehicle_reg', array('reg_No' => $rNo));
        return $query;
    }
  
}

