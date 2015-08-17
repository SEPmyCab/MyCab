<?php

class account_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
		$this->db->where('Email', $form_data['Email']);
$this->db->update('passenger', $form_data);
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
        
        function getData($email=null)
        {
            $data = array();
    $data = $this->db->get_where(
            'passenger',
            array(
            'Email' => $email
            )
        );
    $data = $data->result_array();
  $data['result'] = $data[0];
 
  

   return $data;
        
}
function getPwd($email=null)
        {
            $data = array();
    $data = $this->db->get_where(
            'passenger',
            array(
            'Email' => $email
            )
        );

  

   return $data->result();
        
}

        
        function changePwd($data,$email)
	{
		$this->db->where('Email', $email);
                $this->db->update('passenger',$data);
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}
?>