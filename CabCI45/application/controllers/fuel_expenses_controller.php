<?php

class fuel_expenses_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('fuel_expenses_model'); 
        $this->load->library('../controllers/pages');
    }
    
    /**
     * load fuel expenses details to the view
     * load vehicle details to the view
     */
    public function index() 
    {
        $this->data['fuelData'] = $this->fuel_expenses_model->getFuelExpensesDetails();
        $this->vdata['vehicleData'] = $this->fuel_expenses_model->getVehicleDetails();
        $this->dcost['dieselCost'] = $this->fuel_expenses_model->getTotalDieselCost();
        $this->pcost['petrolCost'] = $this->fuel_expenses_model->getTotalPetrolCost();
        $this->fcost['fuelCost'] = $this->fuel_expenses_model->getTotalFuelCost();
        $this->pages->view('fuel_expenses_view', $this->data+$this->vdata+$this->dcost+$this->pcost+$this->fcost);
       
    }
    
    /**
     * insert fuel bill record details to database
     */
    public function addFuelBill() 
    {
        if ($this->input->post('btnAddBill'))
        {
            $litres=$this->input->post('litres');
            
            if(empty($litres)){
                
                echo "<script>
                      alert('Please Enter Valid Litres Amount');
                      window.location.href='fuel_expenses_controller';
                      </script>";
                
            }
            else{

                    $fuelType=  substr($this->input->post('vehicleIdWithFuelType'),-6);
                    $vehicleID=  chop($this->input->post('vehicleIdWithFuelType'),$fuelType);

                    if($fuelType=='Diesel'){
                        $unitPrice=95.00;
                    }
                    else{

                        $unitPrice=117.00;
                    }


                    $toalCost=$litres*$unitPrice;

                    $data = array(
                    'vehicle_id' => $vehicleID,
                    'fuel_type' => $fuelType,
                    'litres' => $litres,
                    'unit_price' => $unitPrice,
                    'total_cost' =>$toalCost
                    );


                   if ($this->fuel_expenses_model->save($data)) 
                     {
                            echo 
                                "<script>
                                alert('Bill Added');
                                window.location.href='fuel_expenses_controller';
                                </script>";
                     }
                   else{
                            $data=array('error_message' => 'An error occurred. Please try again later');
                            $this->pages->view('err',$data);
                    }
            }
        }
        
        else 
        {
            echo 'Cannot add values';
        }
    }
    
    /**
     * delete fuel bill record details from database
     */
    public function deleteBill() {
        
        if ($this->input->post('btnRemoveBill'))
        {
            $recordId=$this->input->post('recordID');
            if ($this->fuel_expenses_model->delete($recordId)) 
                {
                    echo 
                        "<script>
                        alert('Bill Deleted');
                        window.location.href='fuel_expenses_controller';
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

