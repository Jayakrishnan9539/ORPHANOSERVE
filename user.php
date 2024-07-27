<?php
session_start();
include('include/dbConnect.php');
$qry_ebill = $db->prepare("SELECT * FROM student_details WHERE users_id = '" . $_SESSION['SESS_USER_ID'] . "'");
$qry_ebill->execute();
$row_ebill = $qry_ebill->fetch();
$place = $row_ebill['place'];
$phone = $row_ebill['phone'];
if($row_ebill['delaystatus']==0)
{
    $delay = "No delay";
}
else{
    $delay = $row_ebill['delaystatus']." Min";
}

if($row_ebill['bus_status']==0)
{
    $studentinside = "NO";
}
else{
    $studentinside = "YES";
}

?>
<tr>
    <th>
        <h4 class="mb-0">Name</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $_SESSION['SESS_USER_NAME'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Place</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['place'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Phone</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['phone'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Bus no</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['busno'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Driver name</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['drivername'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Driver Mobile</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['drivermob'] ?></h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Speed</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $row_ebill['speed'] ?> km/h</h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Delay status</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $delay ?> </h4>
    </th>
</tr>
<tr>
    <th>
        <h4 class="mb-0">Student Inside</h4>
    </th>
    <th>
        <h4 class="mb-0"><?php echo $studentinside ?> </h4>
    </th>
</tr>