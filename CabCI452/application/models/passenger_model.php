<?php

class passenger_model extends CI_Model 
{
    function getPassengerD()
    {
        $this->db->select("*");
        $this->db->from('passenger');
        $query = $this->db->get();
        
        return $query->result();
    }

//    function delete($a)
//    {
//        $query = $this->db->delete('passenger', array('Passenger_Id' => $a));
//        return $query;
//    }
}

?>
