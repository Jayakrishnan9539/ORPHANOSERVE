<?php
include('include/auth.php');
include('include/dbConnect.php');
$stmt = $db->prepare( "TRUNCATE TABLE driverbahaviour_drivers_history" );
$stmt->execute();
?>
<script>
    window.location.href = 'index.php';
</script>