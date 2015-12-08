<?php

class vehicle_controller extends CI_Controller  
{  
    function __Construct()
    {
        parent::__Construct ();
        
        $this->load->model('vehicle_model');
        $this->load->library('../controllers/pages');
        $this->load->database();
    }
 
    public function index() 
    {
        $this->pages->view('VehicleDetails');
    }
 
    /**
     * add details of the vehicles 
     */
    public function addVehicle() 
    {
        $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
        $uploadsDirectory = '../CabCI45/upload_img/' ;
        $uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'VehicleDetails.php';

        $fieldname = 'file';

        // Uploading the image

        // possible PHP upload errors
        $errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached');

        // check the upload form was actually submitted else print form
        isset($_POST['btnRegister']) or error('the upload form is needed', $uploadForm);

        // check for standard uploading errors
        ($_FILES[$fieldname]['error'] == 0) or error($errors[$_FILES[$fieldname]['error']], $uploadForm);
	
        // check that the file we are working on really was an HTTP upload
        @is_uploaded_file($_FILES[$fieldname]['tmp_name']) or error('not an HTTP upload', $uploadForm);
	
        // validation... since this is an image upload script we 
        // should run a check to make sure the upload is an image
        @getimagesize($_FILES[$fieldname]['tmp_name']) or error('only image uploads are allowed', $uploadForm);
	
        // make a unique filename for the uploaded file and check it is 
        // not taken... if it is keep trying until we find a vacant one

        $now = time();

        while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
        {
            $now++;
        }

        @move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
	     or error('receiving directory insuffiecient permission', $uploadForm);


        $con = mysqli_connect("localhost","cabeelkc_admin","inhouse2015","cabeelkc_mycab");

        if (mysqli_connect_errno()) 
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $file1 = $now.'-'.$_FILES[$fieldname]['name'];
        $vtype = mysqli_real_escape_string($con, $_POST['vtype']);
        $regNo = mysqli_real_escape_string($con, $_POST['vNo']);
        $manf = mysqli_real_escape_string($con, $_POST['vMnf']);
        $model = mysqli_real_escape_string($con, $_POST['vModel']);
        $seats = mysqli_real_escape_string($con, $_POST['pasgNo']);
        $AC = mysqli_real_escape_string($con, $_POST['AC']);
        $fuel = mysqli_real_escape_string($con, $_POST['fuel']);
        $owner = mysqli_real_escape_string($con, $_POST['name']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $sql="INSERT INTO vehicle_reg(vehicle_type,reg_No,manufacturer,model,seating_capacity,AC,fuel,photo,owner,phone)
              VALUES ('$vtype','$regNo','$manf','$model','$seats','$AC','$fuel','$file1','$owner','$phone')";

        if (!mysqli_query($con,$sql)) 
        {
            die('Error: ' . mysqli_error($con));
        }

        redirect('vehicle_controller');

        mysqli_close($con);

    }
    
    /**
     *  edit vehicle details
     */
    public function edit()
    {
        $reg_no = $this->uri->segment(3);   
        $dt = $this->vehicle_model->edit($reg_no);
        
        $data['regno'] =$dt->reg_No;
        $data['ac'] =$dt->AC;
        $data['fuel'] =$dt->fuel;
        $data['phone'] =$dt->phone;
        
        $this->pages->view('editVehicle_View',$data);
    }
    
    /**
     *  update vehicle details
     */
    public function update()
    {
        if ($this->input->post('btnsubmit')) 
        {
            $data = array(
                'AC' => $this->input->post('ac'),
                'fuel' => $this->input->post('fuel'),
                'phone' => $this->input->post('txtphone')
                 );
        }
 
        else 
        {
            echo 'Cannot retrieve values';
        }
        
        $rNo = $this->input->post('vNo');
 
        if ($this->vehicle_model->update($data,$rNo)) 
	{
            echo 
            "<script>
            alert('Successfully updated');
            window.location.href='vehicle_controller';
            </script>";
	}
	else
	{
            $data=array('error_message' => 'Fields are not updated. Update the fields !!!');
            $this->pages->view('err',$data);
        }
    }
    
    /**
     * delete vehicle
     */
    public function del()
    {
        $vNo = $this->uri->segment(3); 
        $this->vehicle_model->delete($vNo);
        redirect('vehicle_controller');
    }
    
    /**
     * get vehicle details
     */
    public function getVehicles() 
    { 
        $this->pages->view('viewVehicles'); 
    }

}

?>

