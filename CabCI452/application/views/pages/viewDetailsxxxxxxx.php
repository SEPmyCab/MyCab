<?php
    error_reporting(0);
    include 'MyCabTemplate.php';
    $title = "Certify Drivers";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body>
    
<!-- Drivers table -->		  
<table class = "table-bordered" width="75%" align = "center">
        
    <thead> 
        
     <tr><h3>Driver Details</h3></tr> <br>
        
	<tr>
            <th>NIC</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone No</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Certification</th>
            <th>Availability</th>
            <th>Location ID</th>
        </tr>
    
    </thead>
					
    <tbody>
					
	<?php
            
            $title = "View Details";
    
    	    mysql_connect("localhost","root","") or die (mysql_error());
            mysql_select_db("mycab") or die (mysql_error());

            $result = mysql_query("SELECT * FROM driver") or die (mysql_error());
						
            //store the records of the driver table into $row
            while($row = mysql_fetch_array($result))
            {
                //$content = '
               //print the contents of the entry
               echo '<tr>';
               echo '<td>'.$row['NIC'].'</td>';
               echo '<td>'.$row['Email'].'</td>';
               echo '<td>'.$row['Password'].'</td>';
               echo '<td>'.$row['Phone_No'].'</td>';
               echo '<td>'.$row['LName'].'</td>';
               echo '<td>'.$row['FName'].'</td>';
               echo '<td>'.$row['Certification'].'</td>';
               echo '<td>'.$row['Availability'].'</td>';
               echo '<td>'.$row['Location_Id'].'</td>';
               
               echo "<td><a href ='edit_Driver.php?NIC=".$row['NIC']."'>Edit</a></td>";
               echo "<td><a href ='delete_Driver.php?NIC=".$row['NIC']."'>Delete</a></td>";
            }  
             			
	?>
	
        </tr>
    </tbody>
					
</table>

<br>
<br>
<br>


<!-- Passengers table -->	
<table class = "table-bordered" width="75%" align = "center">
        
    <thead> 
        
    <tr><h3>Passenger Details</h3></tr><br>
        
	<tr>
            <th>Passenger ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone No</th>
            <th>Last Name</th>
            <th>First Name</th>
        </tr>
    </thead>
					
    <tbody>
					
	<?php
    
            $result = mysql_query("SELECT * FROM passenger") or die (mysql_error());
						
            //store the records of the passenger table into $row
            while($row = mysql_fetch_array($result))
            {
                //$content = '
               //print the contents of the entry
               echo '<tr>';
               echo '<td>'.$row['Passenger_Id'].'</td>';
               echo '<td>'.$row['Email'].'</td>';
               echo '<td>'.$row['Password'].'</td>';
               echo '<td>'.$row['Phone_No'].'</td>';
               echo '<td>'.$row['LName'].'</td>';
               echo '<td>'.$row['FName'].'</td>';
               
               echo "<td><a href ='edit_Passenger.php?Passenger_Id=".$row['Passenger_Id']."'>Edit</a></td>";
               echo "<td><a href ='delete_Passenger.php?Passenger_Id=".$row['Passenger_Id']."'>Delete</a></td>";
            }  
             			
	?>
	
        </tr>
    </tbody>
					
</table>

     <!--';-->
 
    </body>
</html>
