<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
    <br>
     
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <?php
            if ($this->session->userdata("logged_in") == TRUE && $this->session->userdata['logged_in']['email']=='a@gmail.com') {
        ?>
        <li><a href="index.php/Admin_controller">Administration</a></li>
        <?php } ?>
        <li><a href="index.php/vehicle_controller/getVehicles">Vehicles</a></li>
    </ol>

    <h2 align="center" style="color: darkblue" >Cab Service - Vehicles</h2>
    
    <p style="font-size: medium; color: #003399; margin:2%" >We offer an exclusive cab service in Sri Lanka 
        with a fleet of over 100 cars and vans with drivers that are operating island wide. 
        The main goal of <b><I>mycab</I></b> cab service is based on the concept of providing 
        exceptional and reliable service to our customers.</p><br>
    
    <?php
	 
            $mysqli = new mysqli("localhost","cabeelkc_admin","inhouse2015","cabeelkc_mycab");		 
       
            $results = $mysqli->query("SELECT * FROM vehicle_reg ORDER BY reg_date ASC");
				
            if ($results)
            {
                //fetch results set as object & output HTML
                while($obj= $results->fetch_object())
                {
                    echo '<div class="col-sm-10 col-md-4">';
                        echo '<div class="thumbnail">';
                            echo '<br>';
                            echo '<img src = "upload_img/'.$obj->photo.'" style="height: 180px; width: 80%; display: block;" class="img-rounded"><br>';
                            
                            echo '<div class="caption" style="margin-left: 20%;">';
                            echo '<Strong>Manufacturer  &nbsp;:&nbsp;&nbsp;</Strong>';
                            echo ''.$obj->manufacturer.'<br>';
                            echo '<Strong>Model  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</Strong></td>';
                            echo ''.$obj->model.'</td><br>';
                            echo '<Strong>Seats  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp:&nbsp;&nbsp;</Strong></td>';
                            echo ''.$obj->seating_capacity.'</td><br>';
                            echo '<Strong>AC  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</Strong></td>';
                            echo ''.$obj->AC.'</td><br>';
                            echo '<Strong>Fuel Type  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</Strong></td>';
                            echo ''.$obj->fuel.'</td><br>';
                            echo '</div><br>';
                        echo '</div>';
                    echo '</div>';
                }
            }
			  
            ?>
    
    </body>
</html>
<br><br>