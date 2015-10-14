<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title></title>
        <style type="text/css">
            body { font: normal 10pt Helvetica, Arial; }
            #map { width: 100%; height: 400px; border: 0px; padding: 0px; }
        </style>
        <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>/js/map_js_pathum.js"></script>
        <script type="text/javascript">
            //Sample code written by August Li
            var icon = new google.maps.MarkerImage("assets/images/icons/certified.png");
            var center = null;
            var map = null;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();
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
            function driverDataVanCertified() {
                
                
                
                
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
     
      
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mycab2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getDriverDetails = "SELECT * FROM location l,driver d, vehicle v WHERE d.Location_Id=l.Location_Id AND Availability='available' AND l.Vehicle_ID=v.Reg_No AND d.Certification='CERTIFIED' AND v.Type='van'";
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
        
               echo ("addMarker($Lat,$Lon,'<b>$FName $LName</b><br/>Certification: $Certification<br/>Vehicle Type: $vehicleType<br/>Vehicle Model: $Manufacturer $Model<br/>Number Of Seats: $NoOfSeats<br/>$AC<br/>Phone Number: $phone');\n");
           
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



                center = bounds.getCenter();
                map.fitBounds(bounds);
                
            }
        </script>
    </head>
    <body onload="initialize(); driverDataVanCertified(); " style="margin:0px; border:0px; padding:0px;">
        <div id="map"></div>
<nav id="navigation">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
     
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class=" glyphicon glyphicon-bed" aria-hidden="true"></span> Select Vehicle Type<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="index.php/getlocation_carsShow">Car</a></li>
                                  <li><a href="index.php/getlocation_vansShow">Van</a></li>
                                  <li><a href="index.php/getlocation_three_wheelersShow">Three Wheeler</a></li>
                                  <li><a href="index.php/getlocation_bussesShow">Bus</a></li>
                                  <li><a href="index.php/getlocation_trucksShow">Truck</a></li>
                                </ul>
                        </li>
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                              <input type="text" id="address" class="form-control" placeholder="Your Current Location">
                            </div>
                            <button type="button" onclick="UpdateMap()" class="btn btn-default">Show Nearest Cabs</button>
                        </form>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php/getlocation_van_certifiedShow"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Certified Drivers</a></li>
                        <li><a href="index.php/getlocation_van_noncertifiedShow"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Non Certified Drivers</a></li>
                      </ul>
                     
                    </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
      </nav>
      
        <div class="container">
          <br>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="assets/images/slides/MyCab Slide 1.jpg" alt="My Cab" width="100%" height="500px">
              </div>

              <div class="item">
                <img src="assets/images/slides/MyCab Slide 2.jpg" alt="Pick Me" width="100%" height="500px">
              </div>

              <div class="item">
                <img src="assets/images/slides/MyCab Slide 3.jpg" alt="iDrive" width="100%" height="500px">
              </div>

            <!-- Left and right controls -->
            
          </div>
        </div>
          
	
        
</body>
</html>