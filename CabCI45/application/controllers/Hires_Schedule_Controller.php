<?php
require_once("assets/dhtmlxScheduler_v4.3.1_evaluation/codebase/connector/dataprocessor.php");
require_once("assets/dhtmlxScheduler_v4.3.1_evaluation/codebase/connector/scheduler_connector.php");
require_once("assets/dhtmlxScheduler_v4.3.1_evaluation/codebase/connector/db_phpci.php");
DataProcessor::$action_param ="dhx_editor_status";
 
 
class Hires_Schedule_Controller extends CI_Controller  
{ 
function __Construct()
    {
        parent::__Construct ();
        
 
        $this->load->library('../controllers/pages');
     
    }
 
    public function index() 
    {
        $this->pages->view('Hires_Schedule_View'); 
    }
   
/**
 * loads data from hire table and driver table in to scheduler
 * Two tables are joined
 * drivers are taken to y axis
 */
    public function data() {
        
        $this->load->database();
        $details = new DataConnector($this->db);
        $details->configure("hires", "id", "startTime, endTime, Pickup, Destination,driverNIC");
        $scheduler = new SchedulerConnector($this->db, "PHPCI");
        $list = new OptionsConnector($this->db, "PHPCI");
        $list->render_table("driver","NIC","NIC(value),FName(label)");
        $scheduler->set_options("sections", $list);
        $scheduler->mix("driver", $details, array(
        "driverNIC" => "NIC"
            ));
       
        $scheduler->render_table("hires", "id", "startTime, endTime, Pickup, Destination,driverNIC");
      
        
    }

}