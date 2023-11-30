<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
}
$doctorName = "";
if (isset($_SESSION['id'])) {
    $query = mysqli_execute_query($con, "select fullName from users where id=?", [$_SESSION['id']]);
    while ($row = mysqli_fetch_array($query)) {
        $doctorName = $row['fullName']; // storing the value in the variable
    }
}
?>





<?php $userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <?php
    $pageName = 'Login History';
    include('../include/new-header.php');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <!-- <link rel="stylesheet" href="./style.css"> -->

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include('./include/nav.php'); ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include('../include/navbar.php'); ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">


                                    <div class="card">
                                        <div class="table-responsive text-nowrap">

                                            <div class="col-xl">
                                                <div class="card mb-4">
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                                                <table class="table table-hover" id="sample-table-1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="center">#</th>
                                                                            <th class="hidden-xs">User id</th>
                                                                            <th>Username</th>
                                                                            <th>User IP</th>
                                                                            <th>Login time</th>
                                                                            <th>Logout Time </th>
                                                                            <th> Status </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $docUserType = UserTypeEnum::Doctor->value;
                                                                        $doctorId = $_SESSION['id'];

                                                                        // Using prepared statement to prevent SQL injection
                                                                        $stmt = mysqli_prepare($con, "SELECT * FROM logs WHERE type = ? AND userId = ?");
                                                                        mysqli_stmt_bind_param($stmt, 'ii', $docUserType, $doctorId);
                                                                        mysqli_stmt_execute($stmt);
                                                                        $result = mysqli_stmt_get_result($stmt);

                                                                        $cnt = 1;
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                        ?>

                                                                            <tr>
                                                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                                                <td class="hidden-xs"><?php echo $row['userId']; ?></td>
                                                                                <td class="hidden-xs"><?php echo $row['username']; ?></td>
                                                                                <td><?php echo $row['ip']; ?></td>
                                                                                <td><?php echo $row['loginTime']; ?></td>
                                                                                <td><?php echo $row['logout']; ?></td>
                                                                                <td>
                                                                                    <?php echo ($row['status'] == 1) ? "Success" : "Failed"; ?>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                            $cnt = $cnt + 1;
                                                                        } ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="content-backdrop fade"></div>

                                            <!-- Content wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Layout page -->


                            <!-- Overlay -->
                            <div class="layout-overlay layout-menu-toggle"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Main JS -->
            <!-- start: PDF GEN JAVASCRIPTS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
            <!-- partial -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
            <script src="./PinkSlip_Gen/script.js"></script>

            <?php include('../include/links.php'); ?>

            <script>
                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });
            </script>


</body>

</html>