<?php
include_once "./admin/class/frontend_class.php";
include_once "./admin/class/cart_class.php";
include_once "./admin/session.php";
?>

<?php
// $fm = new Format();
$frontend = new frontend();
$cart = new cart();
$show_cartegory = $frontend->show_cartegory();

Session::init();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Project_CT275</title>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="./assets/image/logo.png" alt="">
        </div>

        <div class="menu">
            <li><a href="index.php">TRANG CHỦ</a></li>
            <li><a href="cartegory.php">SẢN PHẨM</a>
                <ul class="sub-menu">
                    <?php
                    if ($show_cartegory) {
                        foreach($show_cartegory as $key => $resultCarte) {
                    ?>
                            <li id="brand_id">
                                <a href="product_by_cartegory.php?cartegory_id=<?php echo $resultCarte['cartegory_id'] ?>">
                                    <?php echo $resultCarte['cartegory_name'] ?>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li><a href="news.php">TIN TỨC</a></li>
            <li><a href="">THÔNG TIN</a></li>
        </div>
        <div class="others">
            <li>
                <form action="search.php" method="POST">
                    <input type="text" name="tukhoa" required placeholder="Tìm kiếm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </li>
            <li>
                <i class="fa-solid fa-headphones"></i>
            </li>
            <li>
                <i class="fa-solid fa-user"></i>
            </li>
            <li>
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </li>
        </div>
    </header>