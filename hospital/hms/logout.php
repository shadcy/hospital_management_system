<?php
session_start();
include('include/config.php');
$_SESSION['login'] == "";
date_default_timezone_set('Asia/Kolkata');
$ldate = date('d-m-Y h:i:s A', time());
mysqli_query($con, "UPDATE logs SET logout = '$ldate' WHERE userId = '" . $_SESSION['id'] . "' ORDER BY id DESC LIMIT 1"); #Done
session_unset();
//session_destroy();
$_SESSION['errmsg'] = "You have successfully logged out";
?>
<script language="javascript">
    document.location = "../index.php";
</script>