<?php
 include '../components/connect.php';

 session_start();

 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name=? AND password=?");
    $select_admin->execute([$name, $pass]);

    if($select_admin->rowCount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        header('location:dashboard.php');
    }else{
        $message[] = 'incorrect username or password!';
    }

 }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
        <?php
        if(isset($message)){
            foreach($message as $message){

                echo '<div class="message"><span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove()";></i></div>';
            }
        }

?>
    <section class="form-container">
        <form action="" method="POST">
            <h3 class="heading">Login now</h3>
            <input type="text" name="name" placeholder="enter username" class="box">
            <input type="password" name="pass" placeholder="enter password" class="box">
            <input type="submit" name="submit" value="submit" class="btn">
        </form>
    </section>
</body>
</html>
