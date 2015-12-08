<?php

class Columnchart_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('chart_model');
        $this->load->helper('url');
    }

    public function index() {
    //   $this->data['subview'] = 'admin/user/columnchart_view';
	$this->load->view("pages/columnchart_view");
    }

    public function drawChart() {

        $data = $this->chart_model->get_columnchartdata();

        $category = array();
        $category['name'] = 'Driver';

        $series1 = array();
        $series1['name'] = 'Hire 1 priority';
        
        $series2 = array();
        $series2['name'] = 'Hire 2 priority';
        
        $series3 = array();
        $series3['name'] = 'Hire 3 priority';
        
        $series4 = array();
        $series4['name'] = 'Hire 4 priority';

        $series5 = array();
        $series5['name'] = 'Hire 5 priority';

        foreach ($data as $row) {
            $category['data'][] = $row->Driver;
            $series1['data'][] = $row->hire1;
            $series2['data'][] = $row->hire2;
            $series3['data'][] = $row->hire3;
            $series4['data'][] = $row->hire4;
            $series5['data'][] = $row->hire5;
        }

        $result = array();
        array_push($result, $category);
        array_push($result, $series1);
        array_push($result, $series2);
        array_push($result, $series3); 
        array_push($result, $series4); 
        array_push($result, $series5);
        
        print json_encode($result, JSON_NUMERIC_CHECK);

        return $result;
    }
    
      public function changePriority() 
    {
        if ($this->input->post('btnpost'))
        {
            $data = array(
            'driver' => $this->input->post('d1'),
            'hire1' => $this->input->post('p1'),
            'value' => $this->input->post('p2'),    
            );
            
            
                        
            
                if ($this->chart_model->save($data)) 
                {
                  echo 
                        "<script>
                        alert('Priority Posted Successfully');
                        window.location.href='../columnchart_controller';
                        </script>";
                }
                
                else
                {
                    $data=array('error_message' => 'An error occurred. Please try again later');
                    $this->pages->view('err',$data);
                }
        }
        
        else 
        {
            echo 'Cannot retrieve values';
        }
    }
    
    
    
    
    
}