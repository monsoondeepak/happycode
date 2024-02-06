<?php
include '../components/connect.php';

if(!$admin_id){
    header('location:../admin/admin_login.php');
}

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove()";></i></div>';
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
    <header class="header">
        <section class="flex">
            <a href="../admin/dashboard.php" class="logo">Admin <span>Pannel</span></a>
            <nav class="navbar">
                <a href="../admin/dashboard.php">home</a>
                <a href="../admin/products.php">products</a>
                <a href="../admin/placed_orders.php">orders</a>
                <a href="../admin/admin_accounts.php">admin</a>
                <a href="../admin/users_accounts.php">users</a>
                <a href="../admin/messages.php">messages</a>
            </nav>

            <div class="icons">
                <div class="fas fa-bars" id="menu-btn"></div>
                <div class="fas fa-user" id="user-btn"></div>
            </div>
            <div class="profile">
                <?php
                    $admin_id = $_SESSION['admin_id'];
                    $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id=?");
                    $select_profile->execute([$admin_id]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <p><?= $fetch_profile['name'] ?></p>
                <a href="../admin/update_profile.php" class="option-btn">update profile</a>
                <div class="flex-btn">
                    <a href="../admin/admin_login.php" class="option-btn">login</a>
                    <a href="../admin/register_admin.php" class="btn">register</a>
                </div>
                <a href="../components/admin_logout.php" class="delete-btn">logout</a>
            </div>
        </section>
    </header>


<script src="../js/admin_script.js"></script>
</body>
</html>