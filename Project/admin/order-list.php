<?php
include "./header.php";
include "./slider.php";
include "./class/order_class.php";
?>

<?php
$order = new order();
if (isset($_GET['order_code']) && $_GET['order_code'] != 0) {
    $order_code = $_GET['order_code'];
    $del_order = $order->del_order($order_code);
} else {
    $order_code = '';
}

$show_order = $order->show_order();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách đơn hàng</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tùy biến</th>
            </tr>
            <?php
            if ($show_order) {
                $i = 0;
                foreach ($show_order as $key => $val) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $val['order_id'] ?></td>
                        <td><?php echo $val['date'] ?></td>
                        <td><?php
                            if ($val['status'] == 0) {
                                echo 'Đang xử lý...';
                            } else {
                                echo 'Đã xử lý!';
                            }
                            ?></td>
                        <td>
                            <a href="order-detail.php?order_code=<?php echo $val['order_code']?>">Xem</a>
                            <?php
                            if ($val['status'] == 1) {
                            ?>
                            
                             | <a href="order-list.php?order_code=<?php echo $val['order_code']?>">Xóa</a>

                            <?php
                            }
                            ?>

                        </td>
                    </tr>
            <?php

                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>

</html>