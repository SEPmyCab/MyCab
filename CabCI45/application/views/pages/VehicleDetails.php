<?php

$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'vehicle_controller/addVehicle';
$max_file_size = 3000000; 

?>

<html lang="en">
    <head>
    </head>
    <body>
    <br>
     
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <li><a href="index.php/vehicle_controller">Vehicle Details</a></li>
    </ol>

    <h2 align="center" style="color: darkblue" >Vehicle Details</h2><br>
    
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><img src="assets/images/car_icon.png" height="20" width="18">&nbsp; Register Vehicles</a></li>
        <li><a href="#tab2" data-toggle="tab"><i class="glyphicon glyphicon-pencil"></i>&nbsp; View & Edit Vehicle Details</a></li>
    </ul>
    <br>
    
    <div class="tab-content">
    
    <div class="tab-pane active" id="tab1">
    
    <div class="box box-primary" style="float:left; margin-left: 10%; width:40%;" >
       
        <form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post"> 
        <br>
        <div class="input-group">
            <label style="width:240px;" for="type">Vehicle Type</label>
            <span class="input-group-addon"><img src="assets/images/car_icon.png" height="20" width="18"></span>
            <select name="vtype" id="vtype" class="form-control" style = "width: 250px" required="true">
                <option value="">----Select Vehicle Type----</option>
                <option>Car</option>
                <option>Van</option>
                <option>Three Wheeler</option>
                <option>Bus</option>
            </select>    
        </div>
        
        <br>
        <div class="input-group">
            <label style="width:240px;" for="vNo" >Vehicle Registration No</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-info-sign"></span>
            </span>
            <input type="text" class="form-control" id="vNo" name="vNo" placeholder="Vehicle No" value="" required="true" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 48 && event.charCode <= 57' style = "width: 250px">
        </div>
        
        <br>
        <div class="input-group">
            <label style="width:240px;" for="vMnf" >Manufacturer</label>
            <span class="input-group-addon"> <img src="assets/images/icons/car.png" height="20" width="16"></span>
            <input type="text" class="form-control" id="vMnf" name="vMnf" placeholder="Manufacturer" value="" required="true" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122' style = "width: 250px">
        </div>
       
        <br>
        <div class="input-group">
            <label style="width:240px;" for="vModel" >Model</label>
            <span class="input-group-addon"> <img src="assets/images/icons/car.png" height="20" width="16"></span>
            <input type="text" class="form-control" id="vModel" name="vModel" placeholder="Vehicle Model" value="" required="true"  style = "width: 250px">
        </div>
        
        <br>
        <div class="input-group">
            <label style="width:240px;" for="pasgNo" >Seating Capacity</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" id="pasgNo" name="pasgNo" placeholder="No of Passengers" value="" required="true" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style = "width: 250px">
        </div>
           
        <br>
        <div class="form-group" style="width:200%;"> 
            <label style="width:240px;" for="ac">AC / Non AC</label>
            <input type="radio" id="AC" name="AC" value="AC" required="true"> AC&nbsp;&nbsp;
            <input type="radio" id="AC" name="AC" value="Non AC" > Non AC
        </div>
        
        <br>
        <div class="input-group">
            <label style="width:240px;" for="fuel">Fuel Type</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-info-sign"></span>
            </span>
            <select name="fuel" id="fuel" class="form-control" style = "width: 250px" required="true">
                <option value="">----Select Fuel Type----</option>
                <option>Diesel</option>
                <option>Petrol</option>
                <option>Other Fuel Type</option>
            </select>    
        </div>    
        
        <br>
        <div class="form-group" style="width:200%;">
            <label style="width:240px;" for="vPhoto" >Upload Photo</label>
            <input type="file" id="file" name="file" value="" required="true" align="right"/>  
        </div>
       
        <br>    
        <hr width="900px" >    
            
        <br>
        <div class="input-group">
            <label style="width:240px;" for="name" >Owner's Name</label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="" required="true" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122' style = "width: 250px">
        </div>   
            
        <br>
        <div class="input-group">
            <label style="width:240px;" for="phone">Contact No </label>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
            </span>
            <input type="tel" name="phone" id="phone" class = "form-control" style = "width: 250px" placeholder="Phone No" required="true" pattern="[07][12678][0-9]{8}" 
                   onkeypress='return event.charCode >= 48 && event.charCode <= 57' title="Enter only 10 numbers starting from 07.. (0772305287)">
        </div>    
            
        <br>
        <br>
        <input type="submit" id="btnRegister" name ="btnRegister" value="Save Vehicle Details"  class="btn btn-primary"
             onclick="return confirm('Confirm Vehicle details ?');" />
        <br>
        <br>
      </form>              
    </div>
    
    <div class="container" style="float:right; width:35%; margin-top: 8%" >
        <br>
          <img src="assets/images/vehicles.png" alt="Vehicles" style="width:350px;height:160px;">
    </div>
        
    </div>
        
     
    <div class="tab-pane" id="tab2">

    <br>    
    <div style="height:600px;overflow:auto;">
    <table class="table table-bordered table-hover" width="100%" align = "center">
        <thead style="width: 10px">
        <tr>
            <th><strong><i class="glyphicon glyphicon-credit-card"></i>&nbsp; Registration No</strong></th>
            <th><strong><img src="assets/images/icons/car.png" height="20" width="16">&nbsp; Vehicle Type</strong></th>
            <th><strong><i class="glyphicon glyphicon-user"></i>&nbsp; Seats</strong></th>
            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; AC</strong></th>
            <th><strong><i class="glyphicon glyphicon-info-sign"></i>&nbsp; Fuel Type</strong></th>
            <th><strong><i class="glyphicon glyphicon-picture"></i>&nbsp; Photo</strong></th>
            <th><strong><i class="glyphicon glyphicon-earphone"></i>&nbsp; Phone</strong></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
      
        <tbody>
         
        <?php
	 
            $mysqli = new mysqli("localhost","cabeelkc_admin","inhouse2015","cabeelkc_mycab");		 
       
            $results = $mysqli->query("SELECT * FROM vehicle_reg ORDER BY reg_date ASC");
				
            if ($results)
            {
                //fetch results set as object & output HTML
                while($obj= $results->fetch_object())
                {
                    echo '<tr>';
                    echo '<td>'.$obj->reg_No.'</td>';
                    echo '<td>'.$obj->vehicle_Type.'</td>';
                    echo '<td>'.$obj->seating_capacity.'</td>';
                    echo '<td>'.$obj->AC.'</td>';
                    echo '<td>'.$obj->fuel.'</td>';
                    echo '<td><img src = "upload_img/'.$obj->photo.'" height = "120px" width = "180px"></td>';
                    echo '<td>'.$obj->phone.'</td>';
                    echo '<td><a href =../CabCI45/index.php/vehicle_controller/edit/'.$obj->reg_No.'/'.$obj->photo.' class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit</a></td>';
                     echo "<td><a href='../CabCI45/index.php/vehicle_controller/del/".$obj->reg_No."' onclick='return confirm(\"Are you sure you want to delete?\" )' class='btn btn-warning'><i class='glyphicon glyphicon-remove'></i>&nbsp; Delete</a></td>";
                    echo '</tr>';
                }
            }
			  
            ?>
        </tbody>
    </table>  
    </div> 
        
    </div>    
    
    </div> 
    
  </body>
</html>
<br><br>