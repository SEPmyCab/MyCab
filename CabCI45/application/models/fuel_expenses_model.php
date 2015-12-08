<?php

class fuel_expenses_model extends CI_Model 
{
    /**
     * get fuel expenses details
     * @return type
     */
    function getFuelExpensesDetails()
    {
        $this->db->select("*");
        $this->db->from('fuel_expenses');
        $this->db->join('vehicle_reg','fuel_expenses.vehicle_id = vehicle_reg.vehicle_ID');
        $this->db->order_by('fuel_expenses.record_id','asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total diesel cost for the current month
     * @return type
     */
    function getTotalDieselCost()
    {
        $this->db->select("sum(total_cost) AS total_diesel_cost");
        $this->db->from('fuel_expenses');
        $string="fuel_type='Diesel' AND MONTH(filling_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total petrol cost for the current month
     * @return type
     */
    function getTotalPetrolCost()
    {
        $this->db->select("sum(total_cost) AS total_petrol_cost");
        $this->db->from('fuel_expenses');
        $string="fuel_type='Petrol' AND MONTH(filling_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * get total fuel cost for the current month
     * @return type
     */
    function getTotalFuelCost()
    {
        $this->db->select("sum(total_cost) AS total_fuel_cost");
        $this->db->from('fuel_expenses');
        $string="MONTH(filling_date) = MONTH(CURRENT_TIMESTAMP) AND YEAR(CURRENT_TIMESTAMP)";
        $this->db->where($string,NULL,FALSE);
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
     * set fuel expenses details
     * @return type
     */
    function save($data)
    {
        $this->db->insert('fuel_expenses', $data);
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
    /**
     * delete fuel expenses details
     * @return type
     */
    function delete($recordId)
    {
        $this->db->where('record_id', $recordId);
        $this->db->delete('fuel_expenses'); 
        
        if ($this->db->affected_rows() == '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }

}

?>
