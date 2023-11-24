<div class="col-xl">
    <div class="card mb-4">
        <div class="card-body">

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
                    $patientUserType = UserTypeEnum::Patient->value;
                    $sql = mysqli_query($con, "select * from logs where type={$patientUserType};");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>

                        <tr>
                            <td class="center"><?php echo $cnt; ?>.</td>
                            <td class="hidden-xs"><?php echo $row['userId']; ?></td>
                            <td class="hidden-xs"><?php echo $row['username']; ?></td>
                            <td><?php echo $row['ip']; ?></td>
                            <td><?php echo $row['loginTime']; ?></td>
                            <td><?php echo $row['logout']; ?>
                            </td>

                            <td>
                                <?php if ($row['status'] == 1) {
                                    echo "Success";
                                } else {
                                    echo "Failed";
                                } ?>

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