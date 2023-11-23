<div class="col-xl">
	<div class="card mb-4">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h5 class="mb-0">Change Password</h5>

			<small class="text-muted float-end">Admin</small>
		</div>

		<div class="card-body">

			<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); ?>
				<?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>

			<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
				<br>
				<div class="form-group">
					<label for="exampleInputEmail1">
						Current Password
					</label>
					<input type="password" name="cpass" class="form-control" placeholder="Enter Current Password">
				</div>
				<br>
				<div class="form-group">
					<label for="exampleInputPassword1">
						New Password
					</label>
					<input type="password" name="npass" class="form-control" placeholder="New Password">
				</div>
				<br>
				<div class="form-group">
					<label for="exampleInputPassword1">
						Confirm Password
					</label>
					<input type="password" name="cfpass" class="form-control" placeholder="Confirm Password">
				</div>
				<br><br>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>