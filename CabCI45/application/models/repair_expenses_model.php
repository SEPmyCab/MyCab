<?php

class repair_expenses_model extends CI_Model 
{
    /**
     * get repair expenses details
     * @return type
     */
    function getRepairExpensesDetails()
    {
        $this->db->select("*");
        $this->db->from('repair_expenses');
        $this->db->join('vehicle_reg','repair_expenses.vehicle_id = vehicle_reg.vehicle_ID');
        $this->db->order_by('repair_expenses.record_id','asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get vehicle details
     * @return type
     */
    function getVehicleDetails()
    {
        $this->db->select("*");
        $this->db->from('vehicle_reg');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total engine repair cost for the current month
     * @return type
     */
    function getTotalEngineRepairCost()
    {
        $this->db->select("sum(total_cost) AS total_engine_repair_cost");
        $this->db->from('repair_expenses');
        $string="repair_type='Engine Repair' AND MONTH(repair_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total body repair cost for the current month
     * @return type
     */
    function getTotalBodyRepairCost()
    {
        $this->db->select("sum(total_cost) AS total_body_repair_cost");
        $this->db->from('repair_expenses');
        $string="repair_type='Body Repair' AND MONTH(repair_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total tires repair cost for the current month
     * @return type
     */
    function getTotalTiresRepairCost()
    {
        $this->db->select("sum(total_cost) AS total_tires_repair_cost");
        $this->db->from('repair_expenses');
        $string="repair_type='Tires Repair' AND MONTH(repair_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total repair cost for the current month
     * @return type
     */
    function getTotalRepairCost()
    {
        $this->db->select("sum(total_cost) AS total_repair_cost");
        $this->db->from('repair_expenses');
        $string="MONTH(repair_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * set repair expenses details
     * @return type
     */
    function save($data)
    {
        $this->db->insert('repair_expenses', $data);
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
    /**
     * delete repair expenses details
     * @return type
     */
    function delete($recordId)
    {
        $this->db->where('record_id', $recordId);
        $this->db->delete('repair_expenses'); 
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }

}

?>
