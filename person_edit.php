<?php
include('membership_security.php');
include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!-- <link href="css/googleapis.css" rel="stylesheet" />
<link href="css/mdb.css" rel="stylesheet" /> -->

<style>
    * {
        margin: 0;
        padding: 0
    }

    body {
        background-color: #000
    }

    .card {
        width: 350px;
        background-color: #efefef;
        border: none;
        cursor: pointer;
        transition: all 0.5s
    }

    .image img {
        transition: all 0.5s
    }

    .card:hover .image img {
        transform: scale(1.5)
    }

    #btn {
        height: 140px;
        width: 140px;
        border-radius: 50%
    }

    .name {
        font-size: 22px;
        font-weight: bold
    }

    .idd {
        font-size: 14px;
        font-weight: 600
    }

    .idd1 {
        font-size: 12px
    }

    .number {
        font-size: 22px;
        font-weight: bold
    }

    .follow {
        font-size: 12px;
        font-weight: 500;
        color: #444444
    }

    .btn1 {
        height: 40px;
        width: 150px;
        border: none;
        background-color: #000;
        color: #aeaeae;
        font-size: 15px
    }

    .text span {
        font-size: 13px;
        color: #545454;
        font-weight: 500
    }

    .icons i {
        font-size: 19px
    }

    hr .new1 {
        border: 1px solid
    }

    .join {
        font-size: 14px;
        color: #a0a0a0;
        font-weight: bold
    }

    .date {
        background-color: #ccc
    }

    input {
        margin: 0px;
        padding: 0px;
        width: 100%;
        outline: none;
        height: 30px;
        border-radius: 5px;
    }
</style>

<?php
$firstname = $_SESSION['firstname'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($result)) {
?>

        <div class="container mt-6 mb-4 p-3 d-flex justify-content-center">
            <div class="card p-4">
            <form action="membership_access.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="image d-flex flex-column justify-content-center align-items-center"> 
                            <img src="img/customer_image/<?php echo $row['image'] ?>" height="100" width="100" />
                            <hr>

                            <input type="file" name="image" value="<?php echo $row['image']; ?> class="form-control">
                            <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                            
                        <hr>                        
                        <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control">
                        <input type="hidden" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control">

                        <input type="text" id="myInput" name="email" value="<?php echo $row['email']; ?>" class="form-control" readonly="readonly" />
                        <p>edit email will lead in a sign out.<i class="fas fa-toggle-on" id="myButton" data-toggle="modal" data-target="#exampleModal" onclick="myFunction()"></i></p>

                        <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1"></span> </div>
                        <input type="number" name="contact" value="<?php echo $row['contact'] ?>" class="form-control">

                        <div class=" d-flex mt-2"></div>
                        <div class="text mt-3"> <input type="text" value="<?php
                                                                            if ($row['status'] == 1) {
                                                                                echo 'Active';
                                                                            }
                                                                            ?>" class="form-control" readonly>
                            <br><br> </span>
                        </div>

                        <div class=" px-2 rounded mt-4 date "> <span class="join">Joined <?php echo $row['created_at']; ?></span> </div>
                    </div>
                    <hr>
                    <button type="submit" name="update_info" class="btn btn-success form-control">Save</button>
                </form>
            </div>
        </div>

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
                    <button type="submit" name="force" class="btn btn-success form-control">Save</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    

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