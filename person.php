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
    background-color: #efefef
}
</style>

<?php
$firstname = $_SESSION['firstname'];
// echo $email;
$query = "SELECT * FROM tbl_customer WHERE email = '$firstname' ";

$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
?>

<div class="container mt-6 mb-6 p-6 d-flex justify-content-center" >
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center"> 
            <button class="btn btn-light"> <img src="img/customer_image/<?php echo $row['image'] ?>" height="100" width="100" /></button> 
            <span>ID#: <?php echo $row['id']; ?> </span> 
            <span class="name mt-3"><?php echo $row['firstname'] . " " . $row['lastname']; ?></span><span class="idd"><?php echo $row['email']; ?></span>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1"></span> </div>
            
            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">0<?php echo $row['contact'] ?> <span class="follow"><i class="fas fa-phone"></i>

</span></span> </div>
            <div class=" d-flex mt-2"> <a href="person_edit.php?id=<?php echo$row['id']; ?>"><i class="fas fa-edit fa-2x"></i></a> </div>
            <div class="text mt-3"> <span>Role <?php
                                                if($row['status'] == 1){
                                                    echo 'Active';
                                                }
                                            ?><br>
                                            <br> </span> </div>
            <!-- <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span> <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span> </div> -->
            <div class=" px-2 rounded mt-4 date "> <span class="join">Joined <?php echo $row['created_at'];?></span> </div>
        </div>
    </div>
</div>
<br>

<?php
}

?>


<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>