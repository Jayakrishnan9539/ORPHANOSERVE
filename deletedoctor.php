<?php
include('include/auth.php');
include('include/dbConnect.php');
$doctor_id=$_GET['doctor_id'];

$stmt = $db->prepare( "DELETE FROM  orphanage_users WHERE id =:id" );
$stmt->bindParam(':id', $doctor_id);
$stmt->execute();

$stmt = $db->prepare( "DELETE FROM  orphanage_doctors WHERE doctor_id =:id" );
$stmt->bindParam(':id', $doctor_id);
$stmt->execute();

header("location:doctors.php");

?>