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
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $c_pass = $_POST['cpass'];
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    $empty_pass = '';
    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name=?");
    $select_admin->execute([$name]);
    $select_pass = $conn->prepare("SELECT password FROM `admins` WHERE id=?");
    $select_pass->execute([$admin_id]);
    $fetch_password = $select_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_password['password'];
    if($old_pass == $empty_pass){
        $message[] = 'please enter old password!';
    }elseif($old_pass != $prev_pass){
        $message[] = 'old password not matched!';
       
    }elseif($new_pass != $c_pass){
        $message[] = 'confirm password not matched!';
    }else{
            $update_admin = $conn->prepare("UPDATE `admins` SET name=? WHERE id=?");
            $update_admin->execute([$name,$admin_id]);
        }
    }






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update_profile</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php
    include '../components/admin_header.php';

    ?>
    <section class="form-container">
        <form action="" method="POST">
            <h3 class="heading">update now</h3>
            <input type="text" name="name" placeholder="enter username" value="<?= $fetch_profile['name'];?>" maxlength="20" class="box">
            <input type="password" name="old_pass" placeholder="enter old password"  maxlength="20" class="box">
            <input type="pasword" name="new_pass" placeholder="enter new password" maxlength="20" class="box">
            <input type="password" name="cpass" placeholder="confirm password"  maxlength="20" class="box">
            <input type="submit" name="submit" value="update now" class="btn">
        </form>
    </section>
    
</body>
</html>