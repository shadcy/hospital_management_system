<?php #Done
include('../include/config.php');
if (!empty($_POST["specialization_id"])) {

  $sql = mysqli_execute_query($con, "select users.fullName, doctors.id from doctors join users on users.id = doctors.id where doctors.specializationId=?", [$_POST['specialization_id']]); ?>
  <option selected="selected">Select Doctor </option>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['id']); ?>">
      <?php echo htmlentities($row['fullName']); ?>
    </option>
  <?php
  }
}


if (!empty($_POST["doctor_id"])) {

  $sql = mysqli_execute_query($con, "select fees from doctors where id=?", [$_POST['doctor_id']]);
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['fees']); ?>">
      <?php echo htmlentities($row['fees']); ?>
    </option>
<?php
  }
}

?>