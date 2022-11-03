<?php
include "frontend/header.php";
?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'payment'){
    $insert_order = $cart->insert_order($_POST);
    if($insert_order){
        $cart->del_all_cart();
    }
    header('Location:cart.php');
}

if (isset($_POST)) {
    $hoten = $_POST['hoten'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];
    $get_cart = $cart->get_product_cart();
}



?>
<!--Payment  -->
<section class="payment">
    <div class="container">
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-delivery payment-top-item">
                    <i class="fa-solid fa-cart-shopping "></i>
                </div>
                <div class="payment-top-address payment-top-item ">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="?action=payment" method="POST">
            <?php
            if ($get_cart) {
                $thanhtien = 0;
                $tongtien = 0;
                foreach ($get_cart as $key => $val) {
                    $thanhtien = $val['product_price'] * $val['product_quantity'];
                    $tongtien += $thanhtien;
            ?>
                <input type="hidden" name="session_id" value="<?php echo $val['session_id']?>">
            <?php
                }
            }
            ?>
            <div class="payment-content row">
                <div class="payment-content-left">
                    <div class="payment-content-left-method-delivery">
                        <p style="font-weight:bold">Phương thức giao hàng</p>
                        <div class="payment-content-left-method-delivery-item">
                            <input checked type="radio">
                            <label for="">Giao hàng chuyển phát nhanh</label>
                        </div>
                    </div>
                    <div class="payment-content-left-method-payment">
                        <p style="font-weight:bold">Phương thức thanh toán</p>
                        <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                        <div class="payment-content-left-method-payment-item">
                            <input type="radio" name="method" value="Tiền mặt" required>
                            <label for="">Thanh toán khi giao hàng </label>
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input type="radio" name="method" value="Chuyển khoản" required>
                            <label for="">Thanh toán chuyển khoản </label>
                        </div>
                    </div>
                </div>
                <div class="payment-content-right">
                    <h3>Thông tin giao hàng</h3>
                    <span>Họ tên :</span>
                    <div class="payment-content-right-button">
                        <input type="text" readonly name="hoten" id="" value="<?php echo $hoten ?>">
                    </div>
                    <span>Số điện thoại :</span>
                    <div class="payment-content-right-button">
                        <input type="text" readonly name="dienthoai" id="" value="<?php echo $dienthoai ?>">
                    </div>
                    <span>Địa chỉ :</span>
                    <div class="payment-content-right-button">
                        <input type="text" readonly name="diachi" id="" value="<?php echo $diachi ?>">
                    </div>
                </div>
            </div>
            <div class="payment-content-right-payment">
                <input type="submit" name="payment" value="THANH TOÁN" class="btn btn-success">
            </div>
        </form>
    </div>
</section>

<?php
include "frontend/footer.php";
?>