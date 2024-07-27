<?php
include('include/auth.php');
include('include/dbConnect.php');
$orphanage_id=$_GET['orphanage_id'];

$stmt = $db->prepare( "DELETE FROM  orphanage_users WHERE id =:id" );
$stmt->bindParam(':id', $orphanage_id);
$stmt->execute();

$stmt = $db->prepare( "DELETE FROM  orphanage_orphanages WHERE orphanage_id =:id" );
$stmt->bindParam(':id', $orphanage_id);
$stmt->execute();

header("location:orphanage.php");

?>