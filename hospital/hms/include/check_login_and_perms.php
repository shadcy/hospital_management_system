<?php
function check_login_and_perms(int $userType): bool
{
    if (!isset($_SESSION['id'])) {
        header("location:index.php");
        return false;
    } elseif ($_SESSION['userType'] !== $userType) {
        header('location:/ERR404.php');
        return false;
    }
    return true;
}
