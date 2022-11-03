<?php
include "frontend/header.php";
?>

<?php
$show_news = $frontend->show_news();
?>
<section class="new">
    <div class="container">
        <div class="row">
            <div class="header-new">
                <h1 class="header-topic fs-1 text-primary">
                    Điểm sách
                </h1>
            </div>
            <div class="body-new">

                <?php
                foreach ($show_news as $key => $val) {
                ?>
                    <div class="body-content-last">
                        <div class="img-content-last">
                            <a href="news-detail.php?news_id=<?php echo $val['news_id'] ?>">
                                <img src="./admin/uploads/<?php echo $val['news_img'] ?>" alt="">
                            </a>
                        </div>
                        <div class="content-last">
                            <a href="news-detail.php?news_id=<?php echo $val['news_id'] ?>">
                                <h1><?php echo $val['news_title'] ?></h1>
                            </a>
                            <p><?php echo $val['news_desc'] ?> </p>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

</section>

<?php
include "frontend/footer.php";
?>