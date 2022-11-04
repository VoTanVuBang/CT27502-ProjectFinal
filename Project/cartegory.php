<?php
include "frontend/header.php";
?>
<?php

$get_product = $frontend->get_all_product();
?>
<!--Cartegory  -->
<section class="cartegory">
    <div class="container">
        <div class="caetegory-top d-flex mb-4">
            <p>Trang chủ</p> <span>&#10230;</span>
            <p>Tất cả sản phẩm</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            include "frontend/menu_carte.php";
            ?>
            <div class="cartegory-right row">
                <div class="cartegory-right-top-item">
                    <p>TẤT CẢ SẢN PHẨM</p>
                </div>
                <div class="cartegogy-right-content row mt-3">
                    <?php
                    if ($get_product) {
                        foreach($get_product as $key => $get_pro) {
                    ?>

                            <div class="cartegogy-right-content-item col-sm-3">
                                <a href="product_detail.php?product_id=<?php echo $get_pro['product_id'] ?>">
                                    <img src="admin/uploads/<?php echo $get_pro['product_img'] ?>" height="300px">
                                </a>
                                <a href="product_detail.php?product_id=<?php echo $get_pro['product_id'] ?>">
                                    <h1><?php echo ucwords($get_pro['product_name']) ?></h1>
                                </a>
                                <p style="text-align:center"><?php echo number_format($get_pro['product_price'], 0, ',', '.') ?> <sup>đ</sup></p>
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