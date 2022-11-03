<style>
    .admin-content-right-product-add input,select{
            display: block;
            width: 200px;
            height: 30px;
            margin: 6px 0 12px;
            padding-left: 12px;
        }
        .admin-content-right-product-add textarea{
            height: 200px;
            display: block;
            width: 500px;
            margin-bottom: 12px;
            padding: 12px;
        }
        .admin-content-right-product-add button{
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
        .admin-content-right-product-add button:hover{
            background-color: transparent;
            border: 1px solid brown;
            color: brown;
        }
        .admin-content-right-product-add h1{
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
    if($_SERVER['REQUEST_METHOD']==='POST'){
        
        $insert_product = $product->insert_product($_POST,$_FILES);
    }
?>

        <div class="admin-content-right">
            <div class="admin-content-right-product-add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input required type="text" name="product_name">
                    <label for="">--Chọn Danh Mục<span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                    <option value="#" selected>Chọn</option>
                        <?php
                            $show_cartegory = $product -> show_cartegory();
                            if( $show_cartegory) {
                                foreach($show_cartegory as $key => $val){
                        ?>
                        <option value="<?php echo $val['cartegory_id']?>"><?php echo $val['cartegory_name']?></option>
                        <?php
                                    }
                                }    
                        ?>
                    </select>
                    <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
                    <input name="product_price" required  type="text" name="" id="">
                    <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_desc" required  name="" id="editor1" cols="30" rows="10"></textarea>
                    <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
                    <span style="color:red"><?php if(isset($insert_product )){
                        echo ($insert_product);
                    } ?></span>
                    <input name="product_img" required  type="file">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
                CKEDITOR.replace( 'editor1', {
	            filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
	            filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    
} );
</script>
</html>