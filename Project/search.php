<?php
include "frontend/header.php";
?>
<?php

if(isset($_POST)){
    $tukhoa = $_POST['tukhoa'];
}

$search = $frontend->search_product($tukhoa);

?>
<!--Cartegory  -->
<section class="cartegory">
    <div class="container">
        <div class="caetegory-top d-flex">
            <p>Trang chủ</p> <span>&#10230;</span>
            <p>Tìm kiếm</p> <span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            include "frontend/menu_carte.php";
            ?>
            <div class="cartegory-right row">
                <div class="cartegory-right-top-item">
                    <p>TỪ KHÓA: <?php echo $tukhoa?> </p>
                </div>
                <div class="cartegogy-right-content row">
                    <?php
                    if ($search) {
                        foreach($search as $key => $search_pro) {
                    ?>

                            <div class="cartegogy-right-content-item col-sm-3">
                                <a href="product_detail.php?product_id=<?php echo $search_pro['product_id'] ?>">
                                    <img src="admin/uploads/<?php echo $search_pro['product_img'] ?>">
                                </a>
                                <a href="product_detail.php?product_id=<?php echo $search_pro['product_id'] ?>">
                                    <h1><?php echo ucwords($search_pro['product_name']) ?></h1>
                                </a>
                                <p><?php echo number_format($search_pro['product_price'], 0, ',', '.') ?> <sup>đ</sup></p>
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