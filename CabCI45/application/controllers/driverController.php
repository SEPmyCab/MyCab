<?php

require ("application/models/mycab_model.php");

//Contains non-database related function for the Driver page
class driverController  {

   
  
    function CreateDriverDropdownList() {
        $driverModel = new DriverModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($driverModel->GetDriverTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }

    function CreateDriverTables($types) {
        $driverModel = new DriverModel();
        $driverArray = $driverModel->GetDriverByCertification($types);
        $result = "";

        //Generate a driverTable for each driverEntity in array
        foreach ($driverArray as $key => $driver) {
            $result = $result .
                    "<table class = 'driverTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$driver->image' /></th>
                            <th width = '75px' >NIC: </th>
                            <td>$driver->NIC</td>
                        </tr>
                        
                        <tr>
                            <th>Email: </th>
                            <td>$driver->Email</td>
                        </tr>
                    
                        <tr>
                            <th>Phone No: </th>
                            <td>$driver->phone</td>
                        </tr>
                        
                        <tr>
                            <th>Last Name: </th>
                            <td>$driver->lname</td>
                        </tr>
                        
                        <tr>
                            <th>First Name: </th>
                            <td>$driver->fname</td>
                        </tr>

                          <tr>
                            <th>Availability: </th>
                            <td>$driver->availability</td>
                        </tr>
                        
                         <tr>
                            <th>Certification: </th>
                            <td>$driver->certification</td>
                        </tr>

                                            
                     </table>";
        }
        return $result;
    }

    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Drivers");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    
    function GetDriverById($id) {
        $driverModel = new DriverModelModel();
        return $driverModel->GetDriverById($id);
    }

    function GetDriverByCertification($type) {
        $driverModel = new DriverModel();
        return $driverModel->GetDriverByCertification($type);
    }

    function GetDriverTypes() {
        $driverModel = new DriverModel();
        return $driverModel->GetDriverTypes();
    }
    //</editor-fold>
     
     
}

?>
