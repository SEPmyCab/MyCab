<?php

class Chart_model extends CI_Model {    

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_data() {
        $this->db->select('pname, failedTC, passedTC');
        $this->db->from('charts');
        $query = $this->db->get();

        return $query->result();
    }
    
    function get_barchartdata() {
         $this->db->select('Pname, issues, testcases');
        $this->db->from('charts');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_piechartdata() {
        $this->db->select('COUNT(Type) As xc, Reg_No');
        $this->db->from('vehicle');
        $this->db->group_by("Type"); 
        $query = $this->db->get();

        return $query->result();
    }
    
    function get_columnchartdata() {
        $this->db->select('Driver, hire1, hire2, hire3, hire4,hire5');
        $this->db->from('charts');
        $query = $this->db->get();

        return $query->result();
    }
    
    function get_projectTime() {
        $this->db->select('name,description,status,prority_id, progress,totalhours, spentours');
        $this->db->from('project');
        $query = $this->db->get();

        return $query->result();
    }
   function get_projectProgress() {
        $query = "SELECT p.project_id, p.name, p.status,p.progress, p.prority_id FROM project p, priority pr WHERE p.prority_id = pr.priority_id ";
        $result = $this->db->query($query);
        return $result->result();
    }
    
     function save($data)
    {
         
         $this->db->set($data['hire1'],$data['value']);
         $this->db->where('Driver',$data['driver']);
         $this->db->update('charts');
         
        
        if ($this->db->affected_rows() >= '1')
	{
            return TRUE;
	}
		
	return FALSE;
    }
    
}