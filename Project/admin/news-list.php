<?php
include "./header.php";
include "./slider.php";
include "./class/news_class.php";
include "format.php";
?>

<?php
$news = new news();
$show_news =  $news->show_news();
$fm = new Format();

if(isset($_GET['news_id']) && $_GET['news_id'] != ''){
    $id = $_GET['news_id'];
    $del_news = $news->delete_news($id);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách Tin tức</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Tóm tắt</th>
                <th>Tùy biến</th>
            </tr>

            <?php
            if ($show_news) {
                $i = 0;
                foreach ($show_news as $key => $result) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['news_id'] ?></td>
                        <td><?php echo $result['news_title'] ?></td>
                        <td><img src="uploads/<?php echo $result['news_img'] ?>" width="100px" heigh="100px"></td>
                        <td><?php echo $result['news_desc'] ?></td>
                        <td><a href="news-edit.php?news_id=<?php echo $result['news_id'] ?> ">Sửa</a>
                            |<a href="news-list.php?news_id=<?php echo $result['news_id'] ?>">Xóa</a></td>
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