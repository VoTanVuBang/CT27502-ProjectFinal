<?php
include './frontend/header.php';
?>

<?php
if (isset($_GET['news_id']) && $_GET['news_id'] != '') {
    $id = $_GET['news_id'];
} else {
    $id = '';
}


$get_news = $frontend->get_news_detail($id);
?>

<section class="new">
    <div class="container">
        <?php
        foreach ($get_news as $key => $val) {
        ?>
            <div class="header-content">
                <h1>
                    <?php
                    echo $val['news_title']
                    ?>
                </h1>
            </div>
            <div class="content-body">
                <?php
                echo $val['news_content']
                ?>
            </div>

        <?php
        }
        ?>
    </div>
</section>
<!-- Footer -->
<?php
include './frontend/footer.php';
?>