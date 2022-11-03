<?php
include "./header.php";
include "./slider.php";
include "./class/cartegory_class.php";
?>

<?php
    $cartegory = new cartegory;
    if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id']== NULL){
        echo "<script>window.location = './cartegory-list.php'</script>";
    }else{
        $cartegory_id = $_GET['cartegory_id'];
    }
    $get_cartegory = $cartegory -> get_cartegory($cartegory_id);
?>

<?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $cartegory_name = $_POST['cartegory_name'];
        $update_cartegory = $cartegory->update_cartegory($cartegory_name,$cartegory_id);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Thêm Danh Mục</h1>
                <form action="" method="POST">
                    <?php
                    foreach($get_cartegory as $key => $val){
                    ?>
                    <input required  name="cartegory_name" type="text" placeholder="Nhập tên danh mục" 
                        value="<?php echo $val['cartegory_name'] ?>">

                        <?php
                        }
                        ?>
                    <button type="submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>