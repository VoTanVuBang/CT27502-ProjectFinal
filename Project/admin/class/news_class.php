<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../database.php');
?>

<?php
class news extends DB
{

    public function insert_news()
    {
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $news_desc = $_POST['news_desc'];
        $news_img = $_FILES['news_img']['name'];

        $filetarget = basename($_FILES['news_img']['name']);

        $file_name = $_FILES['news_img']['name'];
        $file_temp = $_FILES['news_img']['tmp_name'];
        //Tách tên, đuôi
        $div = explode('.', $file_name);

        //Lấy đuôi ảnh
        $file_ext = strtolower(end($div));

        //Tạo tên ngẫu nhiên
        $news_img = substr(md5(time()), 0, 10) . '.' . $file_ext;

        //Ảnh upload vào thư mục uploads (file tạm)
        $upload_image = "uploads/" . $news_img;
        move_uploaded_file($file_temp, $upload_image);

        if (file_exists("uploads/$filetarget")) {
            $alert = "File đã tồn tại";
            return $alert;
        } else {
            move_uploaded_file($_FILES['news_img']['tmp_name'], "uploads/" . $_FILES['news_img']['name']);
            $query = "INSERT INTO tbl_news(
                    news_title,
                    news_content,
                    news_desc,
                    news_img)
                    VALUES (
                        '$news_title',
                        '$news_content',
                        '$news_desc',
                        '$news_img') ";
            $result = $this->pdo_execute($query);
        }
        header('Location:news-list.php');
        return $result;
    }

    public function show_news()
    {
        $query = "SELECT * FROM tbl_news ORDER BY news_id DESC";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function  get_news($news_id)
    {
        $query = "SELECT * FROM tbl_news WHERE news_id = '$news_id'";
        $result = $this->pdo_query($query);
        return  $result;
    }
    public function update_news($_post, $_files, $id)
    {
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $news_desc = $_POST['news_desc'];
        $news_img = $_FILES['news_img']['name'];

        if (!empty($news_img)) {
            $filetarget = basename($_FILES['news_img']['name']);

            $file_name = $_FILES['news_img']['name'];
            $file_temp = $_FILES['news_img']['tmp_name'];
            //Tách tên, đuôi
            $div = explode('.', $file_name);
            //Lấy đuôi ảnh
            $file_ext = strtolower(end($div));
            //Tạo tên ngẫu nhiên
            $news_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
            //Ảnh upload vào thư mục uploads (file tạm)
            $upload_image = "uploads/" . $news_img;

            move_uploaded_file($file_temp, $upload_image);

            if (file_exists("uploads/$filetarget")) {
                $alert = "File đã tồn tại";
                return $alert;
            } else {
                move_uploaded_file($_FILES['news_img']['tmp_name'], "uploads/" . $_FILES['news_img']['name']);
                $query = "UPDATE tbl_news
                    SET 
                    news_title = '$news_title',
                    news_img = '$news_img' ,
                    news_content = '$news_content' ,
                    news_desc = '$news_desc' 
                    WHERE news_id = $id
                    ";
                $result = $this->pdo_execute($query);
            }
        } else {
            $query = "UPDATE tbl_news
                SET 
                news_title = '$news_title',
                news_content = '$news_content',
                news_desc = '$news_desc'
                WHERE news_id = $id
                ";
            $result = $this->pdo_execute($query);
        }

        header('Location:news-list.php');
        return $result;
    }

    public function delete_news($news_id)
    {
        $query = "DELETE FROM tbl_news WHERE news_id = '$news_id' ";
        $result = $this->pdo_execute($query);
        header('Location: news-list.php');
        return  $result;
    }
}
?>