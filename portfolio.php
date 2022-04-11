<?php
include('body_trainer/trainer_security.php');

include('body_trainer/trainer_header.php');
include('body_trainer/trainer_navbar.php');
?>

<?php
$firstname = $_SESSION['id'];

$query = "SELECT * FROM tbl_admin WHERE email = '$firstname' ";

$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
?>

<body class="bg-light">
	<div class="container">
     	<div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
             	<div class="row z-depth-3">
                 	<div class="col-sm-4 bg-success rounded-left">
        		        <div class="card-block text-center text-white">
                		    <br>
                             <img src="img/customer_image/<?php echo $row['image'] ?>" height="100" width="100" />
                    		<h2 class="font-weight-bold mt-4"><?php echo $row['firstname'] .' '. $row['lastname']; ?></h2>
                    		<p><?php echo $row['level']; ?></p>
                            <a href="portfolio_edit.php?ID=<?php echo$row['ID']; ?>"> <i class="far fa-edit fa-2x mb-4"></i></a>
            		</div>
                </div>    
            		<div class="col-sm-8 bg-white rounded-right">
                    	<h3 class="mt-3 text-center">Information</h3>
                    	<hr class="bg-primary mt-0 w-25">
                   		<div class="row">
                        	<div class="col-sm-8">
                            	<p class="font-weight-bold">Email:</p>
                           		<h6 class=" text-muted"><?php echo $row['email']; ?></h6>
                        	</div>
                        	<div class="col-sm-3">
                            	<p class="font-weight-bold">Phone:</p>
                           		<h6 class="text-muted">+63<?php echo $row['contact']; ?></h6>
                        	</div>
                    	</div>
                    		<hr class="bg-primary">
                   		<div class="row">
                        	<div class="col-sm-6">
                           		<p class="font-weight-bold">Customer Number</p>
                          	  	<h6 class="text-muted"><?php echo $row['ID']; ?></h6>
                        	</div>
                        	<div class="col-sm-6">
                            	<p class="font-weight-bold">Date Registered</p>
                            	<h6 class="text-muted"><?php echo $row['created']; ?></h6>
                        	</div>
                    	</div>
                	   	<hr class="bg-primary">
                	    <ul class="list-unstyled d-flex justify-content-center mt-4">
            	        	<li><a href="#!"><i class="fab fa-facebook-f px-3 h4 text-info"></i></a></li>
        	            	<li><a href="#!"><i class="fab fa-youtube px-3 h4 text-info"></i></a></li>
    	                	<li><a href="#!"><i class="fab fa-twitter px-3 h4 text-info"></i></a></li>
	               		</ul>  
              		</div>
             	</div>
            </div>
        </div>
	</div>
    <br>
    <br>
</body>

<?php 
}
?>


<?php
include('body/script.php');
include('body/footer.php');
?>