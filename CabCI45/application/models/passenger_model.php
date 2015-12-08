<?php

class passenger_model extends CI_Model 
{
    /**
     * get passenger details
     * @return type
     */
    function getPassengerD()
    {
        $this->db->select("*");
        $this->db->from('passenger');
        $query = $this->db->get();
        
        return $query->result();
    }

}

?>
