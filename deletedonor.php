<?php
include('include/auth.php');
include('include/dbConnect.php');
$donor_id=$_GET['donor_id'];

$stmt = $db->prepare( "DELETE FROM  orphanage_users WHERE id =:id" );
$stmt->bindParam(':id', $donor_id);
$stmt->execute();

$stmt = $db->prepare( "DELETE FROM  orphanage_donors WHERE donor_id =:id" );
$stmt->bindParam(':id', $donor_id);
$stmt->execute();

header("location:donors.php");

?>