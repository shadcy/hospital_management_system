<div class="col-xl">
    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="post" name="search">

                <div class="form-group">
                    <label for="doctorname">
                        Search by Name/Mobile No.
                    </label>
                    <input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
                </div>
                <br>
                <button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
                    Search
                </button>
            </form>
            <?php
            if (isset($_POST['search'])) {

                $sdata = $_POST['searchdata'];
            ?>
                <h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>
                <table class="table table-hover" id="sample-table-1">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Patient Name</th>
                            <th>Patient Contact Number</th>
                            <th>Patient Gender </th>
                            <th>Creation Date </th>
                            <th>Updation Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = mysqli_query($con, "select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
                        $num = mysqli_num_rows($sql); #Not worked on
                        if ($num > 0) {
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                        ?>
                                <tr>
                                    <td class="center"><?php echo $cnt; ?>.</td>
                                    <td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
                                    <td><?php echo $row['PatientContno']; ?></td>
                                    <td><?php echo $row['PatientGender']; ?></td>
                                    <td><?php echo $row['CreationDate']; ?></td>
                                    <td><?php echo $row['UpdationDate']; ?>
                                    </td>
                                    <td>

                                        <a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"><i class="fa fa-eye"></i></a>

                                    </td>
                                </tr>
                            <?php
                                $cnt = $cnt + 1;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="8"> No record found against this search</td>

                            </tr>

                    <?php }
                    } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>