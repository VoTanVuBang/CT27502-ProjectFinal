<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../database.php');
?>

<?php
class order extends DB{

    public function show_order(){
        $query = "SELECT * FROM tbl_order ORDER BY order_id DESC";

        $stmt = $this->pdo_query($query);
        return $stmt;
    }

    public function get_order_detail($order_code){
        $query = "SELECT * FROM tbl_order,tbl_product WHERE tbl_order.order_code = '$order_code'
        AND tbl_order.product_id = tbl_product.product_id";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function shipped($order_code){
        
        $query = "UPDATE tbl_order SET status = '1'
                WHERE order_code = '$order_code'";
        $result = $this->pdo_execute($query);
        return $result;

    }

    public function del_order($order_code){
        $query = "DELETE FROM tbl_order WHERE order_code = '$order_code'";
        $result = $this->pdo_execute($query);
        return $result;
    }
}
?>