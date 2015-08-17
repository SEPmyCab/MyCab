<?php
class DriverEntity
{
    public $NIC;
    public $Email;
    public $phone;
    public $lname;
    public $fname;
    public $certification;
    public $availability;
    public  $image;
    
    function __construct($NIC, $Email, $phone, $lname, $fname, $certification, $availability,$image) {
        $this->NIC = $NIC;
        $this->Email = $Email;
        $this->phone = $phone;
        $this->lname = $lname;
        $this->fname = $fname;
        $this->certification = $certification;
        $this->availability = $availability;
        $this->image=$image;
    } 
}
?>

