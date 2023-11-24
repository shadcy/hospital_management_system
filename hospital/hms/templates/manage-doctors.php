<br>
<br>
<div class="col-xl">
    <div class="card mb-4">
        <div class="card-body">
            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
            <table class="table table-hover" id="sample-table-1">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Specialization</th>
                        <th class="hidden-xs">Doctor Name</th>
                        <th>Creation Date </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($con, "select doctors.*,users.fullName, specializations.name as specialization from doctors join users on users.id = doctors.id join specializations on specializations.id = doctors.specializationId;");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>

                        <tr>
                            <td class="center"><?php echo $cnt; ?>.</td>
                            <td class="hidden-xs"><?php echo $row['specialization']; ?></td>
                            <td><?php echo $row['fullName']; ?></td>
                            <td><?php echo $row['creationDate']; ?>
                            </td>

                            <td>
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="edit-doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="bx bx-pencil"></i></a>

                                    <a href="manage-doctors.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class='bx bxs-message-minus'></i></a>
                                </div>
                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <!-- <div class="btn-group" dropdown is-open="status.isopen">
                            <button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
                                <i class="bx bx-dots-vertical-rounded"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                <li>
                                    <a href="#">
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Share
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Remove
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                                </div>
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