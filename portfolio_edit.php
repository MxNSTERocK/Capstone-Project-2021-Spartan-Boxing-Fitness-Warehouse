<?php
include('body_trainer/trainer_security.php');

include('body_trainer/trainer_header.php');
include('body_trainer/trainer_navbar.php');
?>

<style>
    input[type="file"] {
    display: none;
}

.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>

<?php
$firstname = $_SESSION['id'];

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];

    $query = "SELECT * FROM tbl_admin WHERE ID = '$id' ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($result)) {
?>

<body class="bg-light">
	<div class="container">
     	<div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
             	<div class="row z-depth-3">
                 	<div class="col-sm-4 bg-info rounded-left">
        		        <div class="card-block text-center text-white">
                		    <br>
                            <div class=" image d-flex flex-column justify-content-center align-items-center"> 
                            <button class="btn btn-light"> <img src="img/customer_image/<?php echo $row['image'] ?>" height="100" width="100" /></button> 
                            <form action="trainer_access.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="ID" value="<?= $row['ID'] ?>">
                            <label for="file-upload" class="custom-file-upload"> Choose File</label>
                            <input type="file" id="file-upload" name="image" value="<?php echo $row['image']; ?> class="form-control">
                            <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                            
                    		<h2 class="font-weight-bold mt-4">
                            <h6><input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control"></h6>
                            <h6><input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control"></h6>
                    		<p><?php echo $row['level']; ?></p>

                            <button type="submit" name="update_info" class="btn btn-success form-control">Save</button>
                            <hr>
                		</div>
            		</div>
                </div>    
            		<div class="col-sm-8 bg-white rounded-right">
                    	<h3 class="mt-3 text-center">Information</h3>
                    	<hr class="bg-primary mt-0 w-25">
                   		<div class="row">
                        	<div class="col-sm-8">
                            	<p class="font-weight-bold">Email:</p>
                                <h6><input type="text" id="myInput" name="email" value="<?php echo $row['email'] ?>" class="form-control" readonly="readonly" ></h6>
                                <!-- <p>Changes in email will lead in a sign out.<i class="fas fa-toggle-on" id="myButton" data-toggle="modal" data-target="#exampleModal" onclick="myFunction()"></i></p> -->
                        	</div>
                        	<div class="col-sm-3">
                            	<p class="font-weight-bold">Phone:</p>
                                <h6><input type="number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="contact" value="<?php echo $row['contact'] ?>" class="form-control"></h6>
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
                    </form>
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

        <p id="demo"></p>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['firstname'].' '.$row['lastname'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                    <button class="btn btn-secondary">
                            <img src="img/customer_image/<?php echo $row['image'] ?>" height="100" width="100" /></button>
                        </center>    
                    <form action="membership_access.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class=" image d-flex flex-column justify-content-center align-items-center"> 
                        <hr>

                        <input type="text" id="myInput" name="email" value="<?php echo $row['email']; ?>" class="form-control"/>

                    </div>
                    <hr>
                    <button type="submit" name="update_info" class="btn btn-success form-control">Save</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    </body>

<?php
    }
}
?>


<script>
function myFunction() {
  alert("Changing your email address will lead in a sign out.");

}
</script>


<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>