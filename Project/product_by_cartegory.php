<?php
include "frontend/header.php";
?>
<?php
if (isset($_GET['cartegory_id']) && $_GET['cartegory_id'] != '') {
    $id = $_GET['cartegory_id'];
} else {
    $id = '';
}

$product_by_cart = $frontend->product_by_carte($id);
$cartegory_by_pro = $frontend->cartegory_by_product($id);
?>
<!--Cartegory  -->
<section class="cartegory">
    <div class="container">
        <div class="caetegory-top d-flex mb-4">
            <p>Trang chủ</p> <span>&#10230;</span>
            <p>
                <?php
                if ($cartegory_by_pro) {
                    foreach ($cartegory_by_pro as $key => $val) {
                        echo  ucwords($val['cartegory_name']);
                    }
                } else {
                    echo 'Danh Mục Chưa Có Sản Phẩm';
                }
                ?>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            include "frontend/menu_carte.php";
            ?>
            <div class="cartegory-right row">
                <div class="cartegory-right-top-item">
                    <p>
                        <?php
                        if ($cartegory_by_pro) {
                            foreach ($cartegory_by_pro as $key => $val) {
                                echo  ucwords($val['cartegory_name']);
                            }
                        } else {
                            echo 'Danh Mục Chưa Có Sản Phẩm';
                        }
                        ?>
                    </p>
                </div>

                <div class="cartegogy-right-content row">
                    <?php
                    if ($product_by_cart) {
                        foreach ($product_by_cart as $key => $val) {

                    ?>
                            <div class="cartegogy-right-content-item col-sm-3">
                                <a href="product_detail.php?product_id=<?php echo $val['product_id'] ?>">
                                    <img src="admin/uploads/<?php echo $val['product_img'] ?>" height="300px">
                                </a>
                                <a href="product_detail.php?product_id=<?php echo $val['product_id'] ?>">
                                    <h1 class="text-center fw-bold"><?php echo ucwords($val['product_name']) ?></h1>
                                </a>
                                <p class="text-center"><?php echo number_format($val['product_price'], 0, ',', '.') ?><sup>đ</sup></p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "frontend/footer.php";
?>