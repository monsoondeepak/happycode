<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!$admin_id){
    header('location:admin_login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include '../components/admin_header.php' ?>

    <section class="dashboard">
        <h1>dashboard</h1>
        <div class="box-container">
            <div class="box">
                <h3 class="heading">welcome</h3>
                <p><?= $fetch_profile['name']?></p>
                <a href="update_profile.php" class="btn">update profile</a>
            </div>
            <div class="box">
                <?php
                $total_pending = 0;
                $select_pending = $conn->prepare("SELECT * FROM `orders` WHERE payment_status=?");
                $select_pending->execute(['pending']);
                while($fetch_pending = $select_pending->fetch(PDO::FETCH_ASSOC)){
                    $total_pending = $total_pending + $fetch_pending['total_price'];
                }
                
                

                ?>
                <h3 class="heading">$<?= $total_pending; ?><span>/-</span></h3>
                <p>total pending</p>
                <a href="placed_orders.php" class="btn">see orders</a>
            </div>
            <div class="box">
                <?php
                $total_completes = 0;
                $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status=?");
                $select_completes->execute(['orders']);
                while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                    $total_completes = $total_completes+$fetch_completes['total_price'];
                }
                ?>
                <h3 class="heading">$<?= $total_completes;?><span>/-</span></h3>
                <p>total complete</p>
                <a href="placed_orders.php" class="btn">see order</a>
            </div>
            <div class="box">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $total_orders = $select_orders->rowCount();

                ?>
                <h3 class="heading"><?= $total_orders ?></h3>
                <p>total orders</p>
                <a href="placed_orders.php" class="btn">see orders</a>
            </div>
            <div class="box">
                <?php
                 $select_products = $conn->prepare("SELECT * FROM `products`");
                 $select_products->execute();
                 $total_products = $select_products->rowCount();
                ?>
                <h3 class="heading"><?= $total_products?></h3>
                <p>total products</p>
                <a href="products.php" class="btn">add products</a>
            </div>
            <div class="box">
                <?php
                    $select_admins = $conn->prepare("SELECT * FROM `admins`");
                    $select_admins->execute();
                    $total_admins = $select_admins->rowCount();
                ?>
                <h3 class="heading"><?= $total_admins?></h3>
                <p>total admins</p>
                <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
            <div class="box">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $total_users = $select_users->rowCount();
                ?>
                <h3 class="heading"><?= $total_users; ?></h3>
                <p>total users</p>
                <a href="users_accounts.php" class="btn">see users</a>
            </div>
            <div class="box">
                <?php
                    $select_messages = $conn->prepare("SELECT * FROM `message`");
                    $select_messages->execute();
                    $total_messages = $select_messages->rowCount();
                ?>
                <h3 class="heading"><?= $total_messages;?></h3>
                <p>total messages</p>
                <a href="messages.php"class="btn">see messages</a>
            </div>
        </div>
    </section>
    
</body>
</html>