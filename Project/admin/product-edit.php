<style>
    .admin-content-right-product-add input,
    select {
        display: block;
        width: 200px;
        height: 30px;
        margin: 6px 0 12px;
        padding-left: 12px;
    }

    .admin-content-right-product-add textarea {
        height: 200px;
        display: block;
        width: 500px;
        margin-bottom: 12px;
        padding: 12px;
    }

    .admin-content-right-product-add button {
        display: block;
        margin-top: 10px;
        height: 30px;
        width: 100px;
        cursor: pointer;
        border: none;
        color: white;
        transition: all .3s ease;
        background-color: brown;
    }

    .admin-content-right-product-add button:hover {
        background-color: transparent;
        border: 1px solid brown;
        color: brown;
    }

    .admin-content-right-product-add h1 {
        margin-bottom: 20px;
    }
</style>
<?php
include "./header.php";
include "./slider.php";
include "./class/product_class.php";
?>
<?php
$product = new product;
if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
    $id = $_GET['product_id'];
} else {
    $id = '';
}
$show_product_by_id = $product->show_product_by_id($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_product = $product->update_product($_POST, $_FILES, $id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Sửa Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            if ($show_product_by_id) {
                foreach ($show_product_by_id as $key => $val) {

            ?>
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text" name="product_name" value="<?php echo $val['product_name'] ?>">
                    <label for="">--Chọn Danh Mục<span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                        <option value="#">Chọn</option>
                        <?php
                        $show_cartegory = $product->show_cartegory();
                        if ($show_cartegory) {
                            foreach ($show_cartegory as $key => $cart) {

                        ?>
                                <option <?php if ($val['cartegory_id'] == $cart['cartegory_id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $cart['cartegory_id'] ?>">
                                    <?php echo $cart['cartegory_name'] ?>
                                </option>
                        <?php

                            }
                        }
                        ?>
                    </select>

                    <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
                    <input name="product_price" required type="text" value="<?php echo $val['product_price'] ?>">
                    <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_desc" required id="editor1" cols="30" rows="10"><?php echo $val['product_desc'] ?></textarea>
                    <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
                    <span style="color:red"><?php
                                            if (isset($update_product)) {
                                                echo $update_product;
                                            }
                                            ?>
                    </span><br>
                    <img src="uploads/<?php echo $val['product_img'] ?>" width="100px" alt="">
                    <input name="product_img" type="file">
                    <button type="submit">Cập nhật</button>
            <?php
                }
            }
            ?>
        </form>
    </div>
</div>
</section>
</body>

<script>
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'

    });
</script>

<script>
    $(document).ready(function() {
        $("#cartegory_id").change(function() {
            // alert($(this).val());
            var x = $(this).val();
            $.get("product-edit_ajax.php", {
                cartegory_id: x
            }, function(data) {
                $("#brand_id").html(data);
            })
        })
    })
</script>

</html>