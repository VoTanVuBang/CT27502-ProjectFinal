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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_news = $news->insert_news($_POST, $_FILES);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Thêm Tin Tức</h1>
        <!-- action không có địa chỉ, val trong input lưu về server. bằng method Post -->
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Nhập tiêu đề <span style="color: red;">*</span></label>
            <input required type="text" name="news_title">

            <label for="">Tóm tắt<span style="color: red;">*</span></label>
            <textarea name="news_desc" required id="editor1" cols="30" rows="10"></textarea><br>

            <label for="">Nội dung<span style="color: red;">*</span></label>
            <textarea name="news_content" required id="editor2" cols="30" rows="10"></textarea><br>


            <label for="">Ảnh minh họa<span style="color: red;">*</span></label>
            <span style="color:red"><?php if (isset($insert_news)) {
                                        echo ($insert_news);
                                    } ?></span>
            <input name="news_img" required type="file">
            <button type="submit">Thêm</button>
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