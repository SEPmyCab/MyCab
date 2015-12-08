<?php
Class user_model extends CI_Model {


public function registration_insert($data) {


$condition = "Email =" . "'" . $data['Email'] . "'";
$this->db->select('*');
$this->db->from('passenger');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {


$this->db->insert('passenger', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}


public function login($data) {

$condition = "Email =" . "'" . $data['Email'] . "' AND " . "Password =" . "'" . $data['Password'] . "'";
$this->db->select('*');
$this->db->from('passenger');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}


public function read_user_information($sess_array) {

$condition = "Email =" . "'" . $sess_array['email'] . "'";
$this->db->select('*');
$this->db->from('passenger');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

public function check_email_exist($str){
    
    $query = $this->db->get_where('passenger', array('Email' => $str), 1);
     if ($query->num_rows()== 1)
      {
             return true;
            }
            else
            {    
                return false;
            }
}
public function update_random_string($data){
    
   $this->db->where('Email', $data['Email']);
$this->db->update('passenger', $data);


}

}


