<div class="col-xl">


    <div class="card mb-4">
        <div class="card-body">
            <div class="row margin-top-30">
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Doctor Specialization</h5>
                        </div>
                        <div class="panel-body">
                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                            <form role="form" name="dcotorspcl" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Doctor Specialization
                                    </label>
                                    <input type="text" name="doctorspecilization" class="form-control" placeholder="Enter Doctor Specialization">
                                </div>



                                <br>
                                <button type="submit" name="submit" class="btn btn-o btn-primary">
                                    Submit
                                </button>
                            </form>
                        </div>
                        <br><br>

                    </div>
                </div>

            </div>



            <div>
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Docter Specialization</span></h5>

                        <table class="table table-hover" id="sample-table-1">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Specialization</th>
                                    <th class="hidden-xs">Creation Date</th>
                                    <th>Updation Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = mysqli_query($con, "select * from specializations;");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>

                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs"><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['creationDate']; ?></td>
                                        <td><?php echo $row['updationDate']; ?>
                                        </td>

                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <a href="edit-doctor-specialization.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="bx bx-pencil"></i></a>

                                                <a href="doctor-specilization.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class='bx bxs-message-minus'></i></a>
                                            </div>
                                            <div class="visible-xs visible-sm hidden-md hidden-lg">

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

    </div>