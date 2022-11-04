<?php
include "frontend/header.php";
?>

<?php
$get_cart = $cart->get_product_cart();

if (isset($_GET['cart_id']) && $_GET['cart_id'] != '') {
    $id = $_GET['cart_id'];
    $del_product = $cart->del_product_cart($id);
} else {
    $id = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['update']) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_cart = $cart->update_quantity_cart($quantity, $cart_id);
    if ($quantity <= 0) {
        $del_product = $cart->del_product_cart($cart_id);
    }
}

?>

<!-- Cart -->
<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart cart-top-item">
                    <i class="fa-solid fa-cart-shopping "></i>
                </div>
                <div class="cart-top-address cart-top-item ">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="cart-top-payment cart-top-item">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cart-content row">
            <div class="cart-content-left">
                <?php
                if (isset($del_product)) {
                    echo $del_product;
                } elseif (isset($update_cart)) {
                    echo $update_cart;
                }
                ?>
                <table>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>SL</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
                    $qty = 0;
                    $tongtien = 0;
                    $thanhtien = 0;
                    if ($get_cart) {
                        foreach ($get_cart as $key => $val) {
                            $thanhtien = $val['product_price'] * $val['product_quantity'];
                            $qty += $val['product_quantity'];
                            $tongtien += $thanhtien;
                    ?>
                            <tr>
                                <td>
                                    <img src="./admin/uploads/<?php echo $val['product_img'] ?>" alt="">
                                </td>

                                <td>
                                    <p><?php echo $val['product_name'] ?></p>
                                </td>

                                <td>
                                    <form action="" method="POST">
                                        <input type="number" name="quantity" value="<?php echo $val['product_quantity'] ?>">
                                        <input type="hidden" name="cart_id" value="<?php echo $val['cart_id'] ?>">
                                        <input type="submit" name="update" value="Up">
                                    </form>
                                </td>

                                <td>
                                    <p><?php echo number_format($val['product_price'], 0, ',', '.') ?><sup>đ</sup></p>
                                </td>

                                <td>
                                    <p><?php echo number_format($thanhtien, 0, ',', '.') ?><sup>đ</sup></p>
                                </td>

                                <td>

                                    <a href="?cart_id=<?php echo $val['cart_id'] ?>" onclick="return confirm('Are you want to delete <?php echo $val['product_name'] ?>?')">
                                        <span>
                                            X
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6"> Giỏ hàng trống</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="cart-content-right">
                <?php
                $check_cart = $cart->check_cart();
                if ($check_cart) {
                ?>
                    <table>

                        <tr>
                            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td><?php echo $qty ?></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td>
                                <p><?php echo number_format($tongtien, 0, ',', '.') ?><sup>đ</sup></p>
                            </td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td>
                                <p style="color:black; font-weight:bold;"><?php echo number_format($tongtien, 0, ',', '.') ?><sup>đ</sup></p>
                            </td>
                        </tr>
                    </table>

                    <div class="cart-content-right-text">
                        <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 3.000.000 <sup>đ</sup> </p>
                        <p style="color: red; font-weight:bold;">Mua thêm <span style="font-size:18px"><?php echo number_format(3000000-$tongtien,0,',','.') ?></span> <sup>đ</sup> để được miễn phí SHIP</p>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <a href="cartegory.php">
                                <button class="btn btn-primary">TIẾP TỤC MUA SẮM</button>
                            </a>
                        </div>
                        <div class="col-6">

                            <form action="delivery.php?action=delivery" method="POST">
                                <a href="">
                                    <button type="submit" class="btn btn-primary">THANH TOÁN</button>
                                </a>
                            </form>
                        </div>
                    </div>
                <?php

                } else {
                    echo "Giỏ hàng đang trống, hãy mua hàng";
                }
                ?>
            </div>
        </div>
    </div>
</section>


<?php
include "frontend/footer.php";
?>