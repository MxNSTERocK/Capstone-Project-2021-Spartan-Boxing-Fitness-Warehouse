<?php

$regex = "/^[a-zA-Z\d]+$/";
if(isset($_POST['submit'])) {
 if(preg_match($regex,$_POST['text'])){
     $output = "<span style='color:green'>✓</span>";
}
else {
    $output = "<span style='color:red'>x</span>";
    echo 'No space and special character allowed';
}   
}
?>

<form method="POST">
    <input type="password" name='text' autofocus/>
    <input type="Submit" name="submit">
</form>    



    <?php if(isset($output)) {
        echo $output;
    }
    ?>
<?php
// $msg="";
// if(isset($_POST['password'])) {
//   $password = $_POST['password'];
//   $number = preg_match('@[0-9]@', $password);
//   $uppercase = preg_match('@[A-Z]@', $password);
//   $lowercase = preg_match('@[a-z]@', $password);
//   $specialChars = preg_match('@[^\w]@', $password);
 
//   if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
//     $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
//   } else {
//     $msg = "Your password is strong.";
//   }
// }
?>
<!-- <html>
<head>
 <title>Validate password strength in PHP - Clue Mediator</title>
</head>
<body>
  <h3>Validate password strength - <a href="https://www.cluemediator.com/" target="_blank" rel="noopener noreferrer">Clue Mediator</a></h3>
  <form method="POST">
    <input type="password" name="password" required />
    <input type="submit" value="Check" /><br />
    <span><?php //echo $msg?></span>
  </form>
</body>
</html> -->

<?php
// $str = 'd';
// echo password_hash($str);
?>
