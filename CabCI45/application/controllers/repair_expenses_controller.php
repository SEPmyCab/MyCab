<?php

class repair_expenses_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('repair_expenses_model'); 
        $this->load->library('../controllers/pages');
    }
    
    /**
     * load vehicle repair details to the view
     * load vehicle details to the view
     */
    public function index() 
    {
        $this->data['repairData'] = $this->repair_expenses_model->getRepairExpensesDetails();
        $this->vdata['vehicleData'] = $this->repair_expenses_model->getVehicleDetails();
        $this->edata['engineCost'] = $this->repair_expenses_model->getTotalEngineRepairCost();
        $this->bdata['bodyCost'] = $this->repair_expenses_model->getTotalBodyRepairCost();
        $this->tdata['tiresCost'] = $this->repair_expenses_model->getTotalTiresRepairCost();
        $this->rdata['repairCost'] = $this->repair_expenses_model->getTotalRepairCost();
        $this->pages->view('repair_expenses_view', $this->data+$this->vdata+$this->edata+$this->bdata+$this->tdata+$this->rdata);
       
    }
    
    /**
     * insert vehicle repair bill details to the database
     */
    public function addRepairBill() 
    {
        if ($this->input->post('btnAddRepairBill'))
        {
            $partsCost=$this->input->post('partsCost');  
            $technicianCost=$this->input->post('technicianCost');
                
                if(empty($partsCost)||empty($technicianCost)){
                    
                    echo "<script>
                         alert('Bill Added');
                         window.location.href='repair_expenses_controller';
                         </script>";
                    
                }
                else{
                    
                    $vehicleID =  $this->input->post('vehicleId');
                    $RepairType =  $this->input->post('repairType');
                    $toalCost=$partsCost+$technicianCost;

                    $data = array(
                    'vehicle_id' => $vehicleID,
                    'repair_type' => $RepairType,
                    'parts_cost' => $partsCost,
                    'technician_cost' => $technicianCost,
                    'total_cost' =>$toalCost
                    );


                   if ($this->repair_expenses_model->save($data)) 
                     {
                            echo 
                                "<script>
                                alert('Bill Added');
                                window.location.href='repair_expenses_controller';
                                </script>";
                     }
                   else{
                            $data=array('error_message' => 'An error occurred. Please try again later');
                            $this->pages->view('err',$data);
                    }
                    
                }

        }
        else{
            echo 'Cannot add values';
        }
    }
    
    /**
     * delete vehicle repair bill details from the database
     */
    public function deleteRepairBill() {
        
        if ($this->input->post('btnRemoveRepairBill'))
        {
            $recordId=$this->input->post('recordID');
            if ($this->repair_expenses_model->delete($recordId)) 
                {
                    echo 
                        "<script>
                        alert('Bill Deleted');
                        window.location.href='repair_expenses_controller';
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
            echo 'Cannot add values';
        }
        
    }
    
   
} 



?>

