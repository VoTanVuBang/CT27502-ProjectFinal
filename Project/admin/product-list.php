<?php
include "./header.php";
include "./slider.php";
include "./class/product_class.php";
?>

<?php
    $product = new product;
    $show_product =  $product ->show_product();

    if(isset($_GET['product_id']) && $_GET['product_id'] != ''){
        $id = $_GET['product_id'];
        $del_product = $product->delete_product($id);
    }
?>

<div class="admin-content-right">
        <div class="admin-content-right-cartegory-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Danh mục</th>
                        <th>Giá sản phẩm</th>
                        <th>Tùy biến</th>
                    </tr>

                    <?php
                        if($show_product){$i=0;
                            foreach($show_product as $key => $val ){
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $val['product_id']?></td>
                        <td><?php echo $val['product_name'] ?></td>
                        <td><img src="uploads/<?php echo $val['product_img'] ?>" width="100px" heigh="100px"></td>
                        <td><?php echo $val['product_desc'] ?></td>
                        <td><?php echo $val['cartegory_name'] ?></td>
                        <td><?php echo $val['product_price'] ?></td>
                        <td><a href="product-edit.php?product_id=<?php echo $val['product_id'] ?> ">Sửa</a>
                        |<a href="product-list.php?product_id=<?php echo $val['product_id'] ?>">Xóa</a></td>
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