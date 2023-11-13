<?php
function check_login()
{
	if (strlen($_SESSION['login']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "../admin.php";
		$_SESSION["login"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

function check_login_and_perms(int $userType): bool
{
	if (strlen($_SESSION['login']) == 0) {
		$_SESSION["login"] = "";
		header("location:index.php");
		return false;
	} elseif ($_SESSION['userType'] !== $userType) {
		header('location:/ERR404.php');
		return false;
	}
	return true;
}
