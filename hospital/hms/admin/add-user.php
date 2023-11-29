<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');

$userType = UserTypeEnum::Admin->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
}

if (isset($_POST['submit'])) {

    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $password = md5("password");
    $usergender = $_POST['gender'];
    $useraddress = $_POST['address'];
    $usercontactno = $_POST['contact'];
    $userIsStudent = $_POST['isStudent'];

    $newUserType = UserTypeEnum::Patient->value;
    try {
        mysqli_begin_transaction($con);
        $sql = mysqli_execute_query($con, "insert into users (type,email,password,fullName,contactNumber,address,gender) values({$newUserType},?,?,?,?,?,?)", [$useremail, $password, $username, $usercontactno, $useraddress, $usergender]);

        if ($sql) {
            if ($userIsStudent) {
                $sql = mysqli_execute_query($con, "insert into students (id,rollNumber,departmentId,validUntil) values(?,?,?,?)", [mysqli_insert_id($con), $_POST['rollNumber'], $_POST['department'], $_POST['validUntil']]);
            }
            mysqli_commit($con);
            echo "<script>alert('User added successfully');</script>";
            echo "<script>window.location.href ='add-user.php'</script>";
        }
    } catch (mysqli_sql_exception $exp) {
        mysqli_rollback($con);
        if ($exp->getCode() === 1062) {
            if (strpos($exp->getMessage(), 'students_roll_number_uq') !== false) {
                echo "<script>alert('A student with that roll number already exists.');</script>";
            } else {
                echo "<script>alert('A user with that email already exists.');</script>";
            }
        } else {
            echo "<script>alert('There was an issue while creating this user.');</script>";
        }
        echo "<script>window.location.href ='add-user.php'</script>";
    }
}
?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">
<script type="text/javascript">
    let validEmail = false;
    let validRollNumber = false;

    function valid() {
        if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.adddoc.cfpass.focus();
            return false;
        }
        return true;
    }

    function checkemailAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "/api/check_availability.php",
            data: 'emailid=' + $("#email").val(),
            type: "POST",
            dataType: "json",
            success: function(data) {
                $("#email-availability-status").html(data.html);
                $("#loaderIcon").hide();
                validEmail = data.valid;
                enableSubmit();
            },
            error: function() {}
        });
    }

    function checkRollNumberAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "/api/check_roll_number.php",
            data: 'rollNumber=' + $("#rollNumber").val(),
            type: "POST",
            dataType: "json",
            success: function(data) {
                $("#rollnumber-availability-status").html(data.html);
                $("#loaderIcon").hide();
                validRollNumber = data.valid;
                enableSubmit();
            },
            error: function() {}
        });
    }

    function enableSubmit() {
        if ((!document.getElementById('isStudentCheckbox').checked || validRollNumber) && validEmail) {
            $('#submit').prop('disabled', false);
        } else {
            $('#submit').prop('disabled', true);
        }
    }
</script>

<head>
    <?php
    $pageName = 'Add User';
    include('../include/new-header.php');
    ?>
    <link href="/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
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




                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <!-- <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Change Password</h5>

                                        <small class="text-muted float-end">Admin</small>
                                    </div> -->

                                    <div class="card-body">

                                        <form role="form" name="adduser" method="post" onSubmit="return valid();">
                                            <div class="form-group">
                                                <label for="name">
                                                    Full Name
                                                </label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required="true">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="email">
                                                    User Email
                                                </label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required="true" onBlur="checkemailAvailability()">
                                                <span id="email-availability-status"></span>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="address">
                                                    Address
                                                </label>
                                                <textarea name="address" class="form-control" placeholder="Enter Address" required="true"></textarea>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="contact">
                                                    Contact Number
                                                </label>
                                                <input type="text" name="contact" class="form-control" placeholder="Enter Contact Number" required="true">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="block">
                                                    Gender
                                                </label>
                                                <div class="clip-radio radio-primary">
                                                    <input type="radio" id="rg-female" name="gender" value="female">
                                                    <label for="rg-female">
                                                        Female
                                                    </label>
                                                    <input type="radio" id="rg-male" name="gender" value="male">
                                                    <label for="rg-male">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isStudentCheckbox" name="isStudent">
                                                <label class="form-check-label" for="isStudentCheckbox">
                                                    Is Student
                                                </label>
                                            </div>
                                            <br>
                                            <div class="student-fields" style="display: none;">
                                                <div class="form-group">
                                                    <label for="rollNumber">Roll Number</label>
                                                    <input type="text" id="rollNumber" name="rollNumber" class="form-control" placeholder="Enter Roll Number" onBlur="checkRollNumberAvailability()">
                                                    <span id="rollnumber-availability-status"></span>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="department">
                                                        Department
                                                    </label>
                                                    <select name="department" class="form-control">
                                                        <option value="">Select Department</option>
                                                        <?php $ret = mysqli_query($con, "select * from departments;");
                                                        while ($row = mysqli_fetch_array($ret)) {
                                                        ?>
                                                            <option value="<?php echo htmlentities($row['id']); ?>">
                                                                <?php echo htmlentities($row['name']); ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="validUntil">Valid Until</label>
                                                    <input type="date" name="validUntil" class="form-control datepicker" placeholder="Enter Valid Until">
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary" disabled>
                                                Submit
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- Main JS -->

            <?php include('../include/links.php'); ?>

            <?php include_once("../include/body_scripts.php") ?>
            <script>
                document.getElementById('isStudentCheckbox').addEventListener('change', function() {
                    const studentFields = document.querySelector('.student-fields');
                    const studentInputs = studentFields.querySelectorAll('input, select');
                    if (this.checked) {
                        studentFields.style.display = 'block';
                        studentInputs.forEach(function(field) {
                            field.setAttribute('required', 'true');
                        });
                    } else {
                        studentFields.style.display = 'none';
                        studentInputs.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                    }
                    enableSubmit();
                });

                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });

                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '-3d'
                });
            </script>


</body>



</html>