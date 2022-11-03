<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../database.php');
?>

<?php
class product extends DB
{

    public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $stmt = $this->pdo_query($query);
        return  $stmt;
    }

    public function insert_product()
    {
        $product_name = $_POST['product_name'];
        $cartegory_id = $_POST['cartegory_id'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_FILES['product_img']['name'];
        $filetarget = basename($_FILES['product_img']['name']);

        $file_name = $_FILES['product_img']['name'];
        $file_temp = $_FILES['product_img']['tmp_name'];
        //Tách tên, đuôi
        $div = explode('.', $file_name);
        //Lấy đuôi ảnh
        $file_ext = strtolower(end($div));
        //Tạo tên ngẫu nhiên
        $product_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
        //Ảnh upload vào thư mục uploads (file tạm)
        $upload_image = "uploads/" . $product_img;
        move_uploaded_file($file_temp, $upload_image);
        if (file_exists("uploads/$filetarget")) {
            $alert = "File đã tồn tại";
            return $alert;
        } else {
            move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);
            $query = "INSERT INTO tbl_product(
                    product_name,
                    cartegory_id,
                    product_price,
                    product_desc,
                    product_img)
                    VALUES (
                        '$product_name',
                        '$cartegory_id',
                        '$product_price',
                        '$product_desc',
                        '$product_img') ";
            $result = $this->pdo_execute($query);
        }
        header('Location:product-list.php');
        return $result;
    }


    public function update_product($_post, $_files, $id)
    {
        $product_name = $_POST['product_name'];
        $cartegory_id = $_POST['cartegory_id'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_FILES['product_img']['name'];

        if (!empty($product_img)) {
            $filetarget = basename($_FILES['product_img']['name']);

            $file_name = $_FILES['product_img']['name'];
            $file_temp = $_FILES['product_img']['tmp_name'];
            //Tách tên, đuôi
            $div = explode('.', $file_name);
            //Lấy đuôi ảnh
            $file_ext = strtolower(end($div));
            //Tạo tên ngẫu nhiên
            $product_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
            //Ảnh upload vào thư mục uploads (file tạm)
            $upload_image = "uploads/" . $product_img;

            move_uploaded_file($file_temp, $upload_image);

            if (file_exists("uploads/$filetarget")) {
                $alert = "File đã tồn tại";
                return $alert;
            } else {
                move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);
                $query = "UPDATE tbl_product
                    SET 
                    product_name = '$product_name',
                    cartegory_id = '$cartegory_id' ,
                    product_price = '$product_price', 
                    product_img = '$product_img' ,
                    product_desc = '$product_desc' 
                    WHERE product_id = $id
                    ";
                $result = $this->pdo_execute($query);
            }
        } else {

            $query = "UPDATE tbl_product
                SET 
                product_name = '$product_name',
                cartegory_id = '$cartegory_id' ,
                product_price = '$product_price', 
                product_desc = '$product_desc' 
                WHERE product_id = $id
                ";
            $result = $this->pdo_execute($query);
        }

        header('Location:product-list.php');
        return $result;
    }

    public function delete_product($product_id)
    {
        $query = "DELETE FROM tbl_product WHERE product_id = '$product_id' ";
        $result = $this->pdo_execute($query);
        header('Location:product-list.php');
        return  $result;
    }

    public function show_product()
    {
        $query = "SELECT * FROM tbl_product,tbl_cartegory
            WHERE tbl_product.cartegory_id = tbl_cartegory.cartegory_id
            ORDER BY tbl_product.product_id DESC";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function show_product_by_id($id)
    {
        $query = "SELECT * FROM tbl_product,tbl_cartegory
            WHERE tbl_product.cartegory_id = tbl_cartegory.cartegory_id
            AND tbl_product.product_id = '$id'";
        $result = $this->pdo_query($query);
        return  $result;
    }

































    public function  get_brand($brand_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->select($query);
        return  $result;
    }
    public function update_brand($cartegory_id, $brand_name, $brand_id)
    {
        $query = "UPDATE tbl_brand SET brand_name='$brand_name', cartegory_id = '$cartegory_id'  WHERE brand_id = '$brand_id'";
        $result = $this->db->update($query);
        header('Location: brand-list.php');
        return  $result;
    }

    public function delete_brand($brand_id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id' ";
        $result = $this->db->delete($query);
        header('Location: brand-list.php');
        return  $result;
    }
}
?>