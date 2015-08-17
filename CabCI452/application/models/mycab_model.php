<?php

require ("application/models/driverEntity.php");

//Contains database related code for the Driver page.
Class DriverModel {

    //Get all driver types from the database and return them in an array.
    function GetDriverTypes() {
        
      require "application/models/credentials.php";
    // Create connection
     
        $conn = new mysqli($servername, $username, $password, $dbname);
   
        $query = "SELECT DISTINCT Certification FROM driver";
        
        $result = mysqli_query($conn, $query);
        
        $certify = array();

        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            array_push($certify, $row[0]);
        }

        //Close connection and return result.
        mysqli_close($conn);
        return $certify;
            
        }
        
    

    
    //Get driverEntity objects from the database and return them in an array.
     
    function GetDriverByCertification($certify) {
      
      require "credentials.php";
    // Create connection
     
        $conn = new mysqli($servername, $username, $password, $dbname);

        $query = "SELECT * FROM driver WHERE Certification LIKE '$certify'";
        $result = mysqli_query($conn,$query);
        $DriverArray = array();

        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $NIC = $row[0];
            $Email = $row[1];
            $Phone_No = $row[3];
            $Lname = $row[4];
            $Fname = $row[5];
            $certification = $row[6];
            $availability = $row[7];
            $photo=$row[10];
            //Create driver objects and store them in an array.
            $driver = new DriverEntity($NIC, $Email, $Phone_No, $Lname, $Fname, $certification, $availability, $photo);
            array_push($DriverArray, $driver);
        }
        //Close connection and return result
        mysqli_close($conn);
        
        return $DriverArray;
    }

    function GetDriverById($NIC) {
require "credentials.php";
    // Create connection
     
        $conn = new mysqli($servername, $username, $password, $dbname);

        $query = "SELECT * FROM driver WHERE id = $id";
     
        $result = mysqli_query($conn,$query);

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $NIC = $row[0];
            $Email = $row[1];
            $Phone_No = $row[3];
            $Lname = $row[4];
            $Fname = $row[5];
            $certification = $row[6];
            $availability = $row[7];
            $photo=$row[10];
            //Create driver
            $driver = new DriverEntity($NIC, $Email, $Phone_No, $Lname, $Fname, $certification, $availability, $photo);
        }
        //Close connection and return result
        mysqli_close($conn);
        return $driver;
    }

}

    
?>

