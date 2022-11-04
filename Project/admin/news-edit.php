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
include "./class/news_class.php";
?>
<?php
$news = new news();

if (isset($_GET['news_id']) && $_GET['news_id'] != '') {
    $id = $_GET['news_id'];
} else {
    $id = '';
}

$get_news = $news->get_news($id);

if($_SERVER['REQUEST_METHOD']==='POST'){
    $update_news = $news->update_news($_POST, $_FILES,$id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Thêm Tin Tức</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            if ($get_news) {
                foreach($get_news as $key => $result){
            ?>
                    <label for="">Tiêu đề <span style="color: red;">*</span></label>
                    <input required type="text" name="news_title" value="<?php echo $result['news_title'] ?>">

                    <label for="">Tóm tắt<span style="color: red;">*</span></label>
                    <textarea name="news_desc" required id="editor1" cols="30" rows="10">
                    <?php echo $result['news_desc'] ?>
                    </textarea><br>

                    <label for="">Nội dung<span style="color: red;">*</span></label>
                    <textarea name="news_content" required id="editor2" cols="30" rows="10">
                    <?php echo $result['news_content'] ?>
                    </textarea><br>

                    <label for="">Ảnh minh họa<span style="color: red;">*</span></label>
                    <span style="color:red">
                        <?php if (isset($insert_news)) {
                            echo ($insert_news);
                        } ?>
                    </span><br>
                    <img src="uploads/<?php echo $result['news_img']?>" width="200px" alt="">
                    <input name="news_img" type="file">
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

    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'

    });

</script>

</html>