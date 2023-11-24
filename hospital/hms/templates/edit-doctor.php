<h5 style="color: green; font-size:15px; ">
    <?php if ($msg) {
        echo htmlentities($msg);
    } ?> </h5>


<?php $sql = mysqli_execute_query($con, "select doctors.*,specializations.name as specName, users.fullName, users.email, users.address, users.contactNumber as personalNumber from doctors join users on users.id = doctors.id join specializations on specializations.id = doctors.specializationId where doctors.id=?", [$did]);
while ($data = mysqli_fetch_array($sql)) {
?>
    <h4><?php echo htmlentities($data['fullName']); ?>'s Profile</h4>
    <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
    <?php if ($data['updationDate']) { ?>
        <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
    <?php } ?>
    <hr />









    <form role="form" name="adddoc" method="post" onSubmit="return valid();">
        <div class="form-group">
            <label for="DoctorSpecialization">
                Doctor Specialization
            </label>
            <select name="Doctorspecialization" class="form-control" required="required">
                <option value="<?php echo htmlentities($data['specializationId']); ?>">
                    <?php echo htmlentities($data['specName']); ?></option>
                <?php $ret = mysqli_query($con, "select * from specializations;");
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
            <label for="doctorname">
                Doctor Name
            </label>
            <input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
        </div>

        <br>
        <div class="form-group">
            <label for="address">
                Doctor Clinic Address
            </label>
            <textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="fess">
                Doctor Consultancy Fees
            </label>
            <input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['fees']); ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="fess">
                Doctor Contact no
            </label>
            <input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactNumber']); ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="fess">
                Personal Contact no
            </label>
            <input type="text" name="personalcontact" class="form-control" required="required" value="<?php echo htmlentities($data['personalNumber']); ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="fess">
                Doctor Email
            </label>
            <input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
        </div>



        <br>
        <button type="submit" name="submit" class="btn btn-o btn-primary">
            Update
        </button>
        <br>

    </form>



<?php } ?>