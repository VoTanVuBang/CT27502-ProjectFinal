<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../database_frontend.php');
?>

<?php
class frontend extends DB_frontend
{

    public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function  get_cartegory($cartegory_id)
    {
        $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function  product_by_carte($cartegory_id)
    {
        $query = "SELECT * FROM tbl_product,tbl_cartegory 
            WHERE tbl_cartegory.cartegory_id = '$cartegory_id'
            AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function  cartegory_by_product($cartegory_id)
    {
        $query = "SELECT * FROM tbl_product,tbl_cartegory 
            WHERE tbl_cartegory.cartegory_id = '$cartegory_id'
            AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id
            LIMIT 1";
        $result = $this->pdo_query($query);
        return  $result;
    }

    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product ORDER BY product_id DESC";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function get_product_detail($product_id)
    {
        $query = "SELECT * FROM tbl_product,tbl_cartegory
            WHERE tbl_product.cartegory_id = tbl_cartegory.cartegory_id
            AND product_id = '$product_id' ORDER BY product_id DESC";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function search_product($tukhoa)
    {
        $query = "SELECT * FROM tbl_product
            WHERE tbl_product.product_name LIKE '%$tukhoa%'
            ORDER BY tbl_product.product_id DESC";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function show_news()
    {
        $query = "SELECT * FROM tbl_news ORDER BY news_id DESC";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function get_news_detail($id)
    {
        $query = "SELECT * FROM tbl_news WHERE news_id = '$id'";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function get_product_relate($product_id, $carte_id){
        $query = "SELECT * FROM tbl_product,tbl_cartegory 
        WHERE tbl_product.cartegory_id = tbl_cartegory.cartegory_id
        AND tbl_product.cartegory_id = $carte_id
        AND tbl_product.product_id <> '$product_id' ";

        $result = $this->pdo_query($query);
        return $result;
    }
}
?>