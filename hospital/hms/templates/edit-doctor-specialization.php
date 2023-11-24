<div class="row margin-top-30">
    <div class="col-lg-6 col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Doctor Specialization</h5>
            </div>
            <div class="panel-body">
                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                <form role="form" name="dcotorspcl" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            Edit Doctor Specialization
                        </label>

                        <?php

                        $id = intval($_GET['id']);
                        $sql = mysqli_execute_query($con, "select * from specializations where id=?", [$id]);
                        while ($row = mysqli_fetch_array($sql)) {
                        ?> <input type="text" name="doctorspecilization" class="form-control" value="<?php echo $row['name']; ?>">
                        <?php } ?>
                    </div>



                    <br>
                    <button type="submit" name="submit" class="btn btn-o btn-primary">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>