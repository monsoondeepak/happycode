<?php

include '../components/connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!$admin_id){
    header('location:admin_login.php');
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name=?");
    $select_admin->execute([$name]);
    if($select_admin->rowCount() > 0){
        $message[] ='username already exist!';
    }elseif($pass != $cpass){
        $message[] = 'confirm password not matched!';
    }else{
        $insert_admin = $conn->prepare("INSERT INTO `admins` WHERE name=? AND password=?");
        $insert_admin->execute([$name, $cpass]);
        $message[] = 'new admin register successfully!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register_admin</title>
    <link rel="stylesheet" href="..css/admin_style.css">
</head>
<body>
    <?php
    include '../components/admin_header.php';
    ?>
    <section class="form-container">
        <form action="" method="POST">
            <h3 class="heading">register now</h3>
            <input type="text" name="name" placeholder="enter username" required maxlength="20" class="box">
            <input type="password" name="pass" placeholder="enter password" required maxlength="20" class="box">
            <input type="password" name="cpass" placeholder="confirm password" required maxlength="20" class="box">
            <input type="submit" name="submit" value="register now" class="btn">
        </form>
    </section>
    
</body>
</html>