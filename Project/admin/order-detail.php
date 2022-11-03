<?php
include "./header.php";
include "./slider.php";
include "./class/order_class.php";
?>

<?php
$order = new order();
if (isset($_GET['order_code']) && $_GET['order_code'] != 0) {
    $order_code = $_GET['order_code'];
} else {
    $order_code = '';
}

$get_order_detail = $order->get_order_detail($order_code);

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['ship']){
    $ship = $order->shipped($order_code);
    if($ship){
        header('Location:order-list.php');
    }
}

?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Chi tiết đơn hàng</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            <?php
            if ($get_order_detail) {
                $i = 0;
                $thanhtien = 0;
                foreach ($get_order_detail as $key => $val) {
                    $thanhtien = $val['product_price'] * $val['product_quantity'];
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $val['product_id'] ?></td>
                        <td><?php echo $val['product_name'] ?></td>
                        <td><?php echo number_format($val['product_price'], 0, ',', '.') . ' đ' ?></td>
                        <td><?php echo $val['product_quantity'] ?></td>
                        <td><?php echo number_format($thanhtien, 0, ',', '.') . ' đ' ?></td>
                    </tr>
            <?php

                }
            }
            ?>
        </table>
    </div>
    <br>
    <br>
    <div class="admin-content-right-cartegory-list">
        <h1>Thông tin người đặt</h1>
        <table>
            <tr>
                <th>Họ tên</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
            </tr>
            <?php
            if ($get_order_detail) {
                $i = 0;
                foreach ($get_order_detail as $key => $value) {
                    $i++;

            ?>
                    <tr>
                        <td><?php echo $value['hoten'] ?></td>
                        <td><?php echo $value['dienthoai'] ?></td>
                        <td><?php echo $value['diachi'] ?></td>
                    </tr>
            <?php
                    if ($i >= 1) {
                        break;
                    }
                }
            }
            ?>
        </table>
    </div>
    <form action="" method="POST">
            <input type="submit" name="ship" value="Giao hàng">
    </form>
</div>
</section>
</body>

</html>