  <!DOCTYPE html>
<html>
<head>

</head>

<body onload="initialize(); driverDataAllVehicles();">
<div id="map" style="width:100%;height:400px;"></div>
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
                        <li><a href="index.php/getlocation_all_certifiedShow"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Certified Drivers</a></li>
                        <li><a href="index.php/getlocation_all_noncertifiedShow"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Non Certified Drivers</a></li>
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
        
<p>
 
ICT King/Biz Care offer world-class custom software development, software testing,
                quality assurance and business technology optimization services. This project is focused on
                designing and developing a GPS based Online Cab Booking System - My Cab.
                This system consists of a web based application and two separate mobile applications.
                In the passenger’s mobile application, they can reserve a vehicle and in the driver’s mobile
                application, they can indicate their availability (whether free or busy). The main goal of this
                proposed system is to simplify the process of ordering a cab and real-time monitoring the
                vehicles.
                                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.
                                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.


</p>


<p>
  

                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.
                                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.
                                    Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.
                                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.

</p>


<p>
                Passengers who are registered in the system can reserve vehicles via the web
                application and also with the mobile application. They can reserve vehicles by searching for
                the cabs which are closer to their current location. The system immediately matches the
                passenger with a cab which is nearest to the specified location and returns the vehicle number
                and the phone number of the driver to the passenger.
                The project will be developed in two stages. During the first stage, the web
                application for the passengers and the mobile application for the drivers will be developed.
                Next, the mobile application for the passengers will be developed.
</p>

        
<script src="<?php echo asset_url();?>/js/map_js_pathum.js"></script>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-162157-1";
urchinTracker();
</script>

<script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
<script type ="text/javascript" src="http://www.geocodezip.com/scripts/v3_epoly.js"></script>
</body>
<!--?php require 'getlocation.php';?-->
</body>
</html> 
        

