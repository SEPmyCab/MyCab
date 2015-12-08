<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title></title>

        <script type="text/javascript">
            
           
            var center = null;
            var map = null;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();
            var icon = new google.maps.MarkerImage("assets/images/icons/taxi.png");
  
            
            function addMarker(lat, lng, info) {
            
        
                var pt = new google.maps.LatLng(lat, lng);
                bounds.extend(pt);
                var marker = new google.maps.Marker({
                    
                    position: pt,
                    icon: icon,
                    map: map
                });
                var popup = new google.maps.InfoWindow({
                    content: info,
                    maxWidth: 300
                });
                google.maps.event.addListener(marker, "click", function() {
                    if (currentPopup != null) {
                        currentPopup.close();
                        currentPopup = null;
                    }
                    popup.open(map, marker);
                    currentPopup = popup;
                });
                google.maps.event.addListener(popup, "closeclick", function() {
                    map.panTo(center);
                    currentPopup = null;
                });
            }
            
			
            function driverDataAllVehicles() {      
                
                <?php

           
				include 'create_connection.php';

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$getDriverDetails = "SELECT * FROM location l,driver d, vehicle v WHERE d.Location_Id=l.Location_Id AND d.Availability='Available' AND l.Vehicle_ID=v.Reg_No";
				$driverResult = $conn->query($getDriverDetails);



				if ($driverResult->num_rows > 0) {
					// output data of each row
					while($row = $driverResult->fetch_assoc()) {
						$Lat=$row['Latitude'];
						$Lon=$row['Longitude'];
						$NIC=$row['NIC'];
						$FName=$row['FName'];
						$LName=$row['LName'];
						$Certification=$row['Certification'];
						$Manufacturer=$row['Manufacturer'];
						$Model=$row['Model'];
						$vehicleType=$row['Type'];
						$NoOfSeats=$row['No_Of_Passengers'];
						$AC=$row['AC'];
						$phone=$row['Phone_No'];

						$email='';
                                                if (isset($this->session->userdata['logged_in']['email'])){
                                                      $email=$this->session->userdata['logged_in']['email'];}
                                                if ($email!=''){
        
                                                     echo ("addMarker($Lat,$Lon,'<b>$FName $LName</b><br/>Certification: $Certification<br/>Vehicle Type: $vehicleType<br/>Vehicle Model: $Manufacturer $Model<br/>Number Of Seats: $NoOfSeats<br/>$AC<br/>Phone Number: $phone');\n");
                                               }
                                              else{
                                                  echo ("addMarker($Lat,$Lon,'<b>Please Login to see details about driver.');\n");
              
                                              }
						   
					}
				} else {
					echo "0 results";
				}


				$conn->close();
								 
				 
				 ?>
  
            }
        </script>
    </head>
    <body>
    </body>
</html>