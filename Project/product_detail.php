<?php
include "frontend/header.php";
?>
<?php
if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
    $id = $_GET['product_id'];
} else {
    $id = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addToCart = $cart->add_to_cart($quantity, $id);
}

$get_product = $frontend->get_product_detail($id);
if ($get_product) {
    foreach ($get_product as $key => $val) {
        $carte_name = $val['cartegory_name'];
        $carte_id = $val['cartegory_id'];
        $pro_name = $val['product_name'];
    }
}

$get_product_relate = $frontend->get_product_relate($id, $carte_id);

?>
<!-- Product -->
<section class="product">
    <div class="container">
        <div class="product-top d-flex">
            <p>Trang chủ</p> <span>&#10230;</span>
            <p><?php echo ucwords($carte_name) ?></p> <span>&#10230;</span>
            <p><?php echo ucwords($pro_name) ?></p>
        </div>
        <?php
        foreach ($get_product as $key => $pro) {
        ?>
            <div class="product-content row">
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                        <img src="admin/uploads/<?php echo $pro['product_img'] ?>" alt="">
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h1 class="fs-1 text-uppercase"><?php echo ucwords($pro['product_name']) ?></h1>
                        <div class="product-content-right-product-name-price">
                            <h1 class="fs-4">Giá: <?php echo number_format($pro['product_price'], 0, ',', '.') ?><sup>đ</sup></h1>
                        </div>
                        <form action="" method="POSt">
                            <div class="d-flex">
                                <p class="fs-5 fw-bold">Số lượng: </p>
                                <input type="number" name="quantity" min="1" value="1" class="w-25">
                            </div>

                            <div class="product-content-right-product-button">
                                <button type="submit" name="submit">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <p>MUA HÀNG</p>
                                </button>
                        </form>
                        <?php
                        if (isset($addToCart)) {
                            echo $addToCart;
                        }
                        ?>
                        <button>
                            <a href="">
                                <p>TÌM TẠI CỬA HÀNG</p>
                            </a>
                        </button>
                    </div>
                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title row">
                                <div class="product-content-right-bottom-content-title-item text-center fw-bold">
                                    <p>CHI TIẾT SẢN PHẨM</p>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-detail">
                                    <?php
                                    echo $pro['product_desc'];
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php
        }
?>
</div>
</section>

<!-- Footer product -->
<section class="product-related container">
    <div class="product-related-title">
        <p>SẢN PHẨM LIÊN QUAN</p>
    </div>
    <div class="product-content row ">
        <?php
        if ($get_product_relate) {
            foreach ($get_product_relate as $key => $relate) {
        ?>
                <div class="product-related-item col-sm-3">
                    <img src="./admin/uploads/<?php echo $relate['product_img'] ?>" alt="">
                    <h1 class="text-center"><?php echo $relate['product_name'] ?></h1>
                    <div class="price row">
                        <p class="fw-bold"><?php echo number_format($relate['product_price'], 0, ',', '.') ?><sup>đ</sup></p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo 'Chưa có sản phẩm!!!';
        }
        ?>
    </div>
</section>

<?php
include "frontend/footer.php";
?>