<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Change Password</h5>

            <small class="text-muted float-end">Admin</small>
        </div>

        <div class="card-body">

            <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                <div class="form-group">
                    <label for="DoctorSpecialization">
                        Doctor Specialization
                    </label>
                    <select name="Doctorspecialization" class="form-control" required="true">
                        <option value="">Select Specialization</option>
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
                    <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
                </div>

                <br>
                <div class="form-group">
                    <label for="address">
                        Doctor Clinic Address
                    </label>
                    <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="fess">
                        Doctor Consultancy Fees
                    </label>
                    <input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true">
                </div>
                <br>
                <div class="form-group">
                    <label for="fess">
                        Doctor Contact no
                    </label>
                    <input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true">
                </div>
                <br>
                <div class="form-group">
                    <label for="fess">
                        Doctor Email
                    </label>
                    <input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
                    <span id="email-availability-status"></span>
                </div>


                <br>

                <div class="form-group">
                    <label for="exampleInputPassword1">
                        Password
                    </label>
                    <input type="password" name="npass" class="form-control" placeholder="New Password" required="required">
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputPassword2">
                        Confirm Password
                    </label>
                    <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required">
                </div>

                <br>

                <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary" disabled>
                    Submit
                </button>
            </form>

        </div>
    </div>
</div>