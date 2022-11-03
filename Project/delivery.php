<?php
include "frontend/header.php";
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'delivery') {
    $get_cart = $cart->get_product_cart();
}
?>
<!-- Delivery-->
<section class="delivery">
    <div class="container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-delivery delivery-top-item">
                    <i class="fa-solid fa-cart-shopping "></i>
                </div>
                <div class="delivery-top-address delivery-top-item ">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="delivery-top-payment delivery-top-item">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <p>Vui lòng chọn địa chỉ giao hàng</p>

                <form action="payment.php" method="POST">
                    <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Họ tên <span style="color:red ;">*</span></label>
                            <input type="text" name="hoten" id="" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Điện thoại <span style="color:red ;">*</span></label>
                            <input type="text" name="dienthoai" id="" required>
                        </div>
                    </div>

                    <div class="delivery-content-left-input-bottom">
                        <label for="">Địa chỉ<span style="color:red ;">*</span></label>
                        <input type="text" name="diachi" id="" required>
                    </div>

                    <div class="delivery-content-left-button row">
                        <a href="cart.php"><span>&#171;</span>
                            <p>Quay lai giỏ hàng</p>
                        </a>
                        <a href="">
                            <button class="w-50">
                                <p style="font-weight:bold ;">THANH TOÁN VÀ GIAO HÀNG</p>
                            </button>
                        </a>
                    </div>
                </form>

            </div>
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php
                    if ($get_cart) {
                        $thanhtien = 0;
                        $tongtien = 0;
                        foreach ($get_cart as $key => $val) {
                            $thanhtien = $val['product_price'] * $val['product_quantity'];
                            $tongtien += $thanhtien;
                    ?>
                            <tr>
                                <td><?php echo $val['product_name'] ?></td>
                                <td><?php echo number_format($val['product_price'], 0, ',', '.') ?></td>
                                <td><?php echo $val['product_quantity'] ?></td>
                                <td><?php echo number_format($thanhtien, 0, ',', '.') ?><sup>đ</sup></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <td colspan="4"> Giỏ hàng trống</td>
                        </tr>

                    <?php
                    }
                    ?>

                    <tr>

                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Tổng tiền hàng</td>
                        <td style="font-weight: bold;"><?php echo number_format($tongtien, 0, ',', '.') ?><sup>đ</sup></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
include "frontend/footer.php";
?>