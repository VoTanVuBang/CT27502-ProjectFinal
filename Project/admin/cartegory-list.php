<?php
include "./header.php";
include "./slider.php";
include "./class/cartegory_class.php";
?>

<?php
$cartegory = new cartegory();
$show_cartegory =  $cartegory->show_cartegory();

if (isset($_GET['cartegory_id']) && $_GET['cartegory_id'] != 0) {
    $id = $_GET['cartegory_id'];
    $del_cart = $cartegory->delete_cartegory($id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách danh mục</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Tùy biến</th>
            </tr>

            <?php
            if ($show_cartegory) {
                $i = 0;
                foreach ($show_cartegory as $key => $val) {
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $val['cartegory_id'] ?></td>
                        <td><?php echo $val['cartegory_name'] ?></td>
                        <td><a href="cartegory-edit.php?cartegory_id=<?php echo $val['cartegory_id'] ?> ">Sửa</a> |
                            <a href="cartegory-list.php?cartegory_id=<?php echo $val['cartegory_id'] ?>">Xóa</a>
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