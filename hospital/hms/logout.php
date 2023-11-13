<?php
session_start();
include('include/config.php');
date_default_timezone_set('Asia/Kolkata');
$ldate = date('d-m-Y h:i:s A', time());
mysqli_execute_query($con, "UPDATE logs SET logout = ? WHERE userId = ? ORDER BY id DESC LIMIT 1", [$ldate, $_SESSION['id']]); #Done
session_unset();
//session_destroy();
$_SESSION['errmsg'] = "You have successfully logged out";
?>
<script language="javascript">
    document.location = "../index.php";
</script>