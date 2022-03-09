<?php
include('security.php');

include('body/header.php');
include('body/navbar.php');
?>

<link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" />

<center>
<div class="col-xl-9 col-md-9 mb-9">
	<div class="card border shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">
						<div class="container">
							<div class="card-body">
								<div class="col-md-3"></div>
								<div class="col-md-12 well">
									<h3 class="text-primary">
										<center> <?= Title ?></center>
									</h3>
									<hr style="border-top:1px dotted #ccc;" />
									<div class="col-md-3"></div>
									<div class="col-md-12">
										<form method="POST" action="send_email.php">
											<div class="form-group">
												<label>Email:</label>
												<input type="email" class="form-control" readonly value="<?php
																											if ($_GET['emails']) {
																												echo $_GET['emails'];
																											}; ?>" name="emails" required="required" />
											</div>
											<div class="form-group">
												<label>Subject</label>
												<input type="text" class="form-control" name="subject" value="Membership Status" readonly />
											</div>
											<div class="form-group">
												<label>Message</label>
												<textarea type="text" class="form-control" cols="5" rows="5" name="message" required="required"></textarea>
												<input type="hidden" name="ID" value="<?php
																						if ($_GET['id']) {
																							echo $_GET['id'];
																						}; ?>">
											</div>
											<center><button name="send" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> Send</button></center>
										</form>
										<br />
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</center>
&nbsp;


















</div>

</body>

</html>

<?php
include('body/script.php');
include('body/footer.php');
?>