<?php
$fname = "John";
$lname = "Smith";
$address = "Sukowidi Residence";
$city = "Banyuwangi";
$country = "Indonesia";

$contact = compact('fname', 'lname', 'address', 'city', 'country');
print_r($contact);
?>