<?php

require 'application/controllers/driverController.php';
$driverController = new driverController();

if(isset($_POST['types']))
{
    //Fill page with coffees of the selected type
    $driverTables = $driverController->CreateDriverTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $driverTables = $driverController->CreateDriverTables('%');
}

//Output page data
//$title = 'Driver overview';
echo $driverController->CreateDriverDropdownList(). $driverTables;


?>
