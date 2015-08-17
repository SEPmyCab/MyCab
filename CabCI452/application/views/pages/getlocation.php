<?php 
       $status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}
 
    ?><html>
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
                 /*
 
                require "Model/credentials.php";
    // Create connection
     
        $conn = new mysqli($servername, $username, $password, $dbname);
   
       $query = mysql_query("SELECT * FROM driver d,location l WHERE d.Location_Id=l.Location_Id");
        $result = mysqli_query($conn,$query);
        $DriverArray = array();

 while ($row = mysql_fetch_array($query)){
 $name=$row['FName'];
 $lat=$row['Latitude'];
 $lon=$row['longitude'];
 $desc=$row['Certification'];
                  * 
                  */
           
    // Create connection
     
      
$servername = "sql307.byethost15.com";
$username = "b15_16045152";
$password = "byethost321";
$dbname = "b15_16045152_cab";

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
              
                
                
                
                
           /*     
                
                addMarker(51.514980, -0.144328,'<b>100 Club</b><br/>Oxford Street, London  W1&lt;br/&gt;3 Nov 2010 : Buster Shuffle&lt;br/&gt;');
addMarker(51.521710, -0.071737,'<b>93 Feet East</b><br/>150 Brick Lane, London  E1 6RU&lt;br/&gt;7 Dec 2010 : Jenny &amp; Johnny&lt;br/&gt;');
addMarker(51.511010, -0.120140,'<b>Adelphi Theatre</b><br/>The Strand, London  WC2E 7NA&lt;br/&gt;11 Oct 2010 : Love Never Dies');
addMarker(51.521620, -0.143394,'<b>Albany, The</b><br/>240 Gt. Portland Street, London  W1W 5QU');
addMarker(51.513170, -0.117503,'<b>Aldwych Theatre</b><br/>Aldwych, London  WC2B 4DF&lt;br/&gt;11 Oct 2010 : Dirty Dancing');
addMarker(51.596490, -0.109514,'<b>Alexandra Palace</b><br/>Wood Green, London  N22&lt;br/&gt;30 Oct 2010 : Lynx All-Nighter');

*/

                
            }
        </script>
    </head>
    <body>
    </body>
</html>