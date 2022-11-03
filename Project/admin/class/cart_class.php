<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../database_frontend.php');

?>

<?php
class cart extends DB_frontend
{

    public function add_to_cart($quantity, $id)
    {
        
        $sId = session_id();

        $query_cart = "SELECT * FROM tbl_cart WHERE product_id = '$id'";
        $check_cart = $this->pdo_query($query_cart);

        if ($check_cart) {
            $msg = "<span style='color:red;';>Sản phẩm đã có trong giỏ hàng</span>";
            return $msg;
        } else {
            $query_insert = "INSERT INTO tbl_cart(session_id, product_id, product_quantity) VALUES ('$sId', '$id','$quantity')";
            $result = $this->pdo_execute($query_insert);
            if ($result) {
                header('Location:cart.php');
            } 
        }
    }

    public function update_quantity_cart($quantity, $cart_id)
    {
        $query = "UPDATE tbl_cart SET
                product_quantity = '$quantity'
                WHERE cart_id = '$cart_id'";
        $result = $this->pdo_execute($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = '<span style="color:red;">Cập nhật sản phẩm thất bại</span>';
            return $msg;
        }
    }

    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart,tbl_product 
        WHERE session_id = '$sId'
        AND tbl_cart.product_id = tbl_product.product_id";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function check_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE session_id = '$sId'";
        $result = $this->pdo_query($query);
        return $result;
    }

    public function del_product_cart($cart_id)
    {
        
        $query = "DELETE FROM tbl_cart WHERE cart_id = '$cart_id'";
        $result = $this->pdo_execute($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $msg = '<span style="color:red">Sản phẩm đã xóa</span>';
            return $msg;
        }
    }

    public function del_all_cart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE session_id = '$sId'";
        $result = $this->pdo_execute($query);
        return $result;
    }

    public function insert_order()
    {
        $hoten = $_POST['hoten'];
        $dienthoai = $_POST['dienthoai'];
        $diachi = $_POST['diachi'];
        $sId = $_POST['session_id'];
        $order_code = rand(0,9999);
        $method = $_POST['method'];

        $get_cart = "SELECT * FROM tbl_cart WHERE session_id ='$sId'";
        $result_get = $this->pdo_query($get_cart);
        if($result_get){
           foreach($result_get as $key => $val){
            $product_id = $val['product_id'];
            $product_quantity = $val['product_quantity'];

            $query = "INSERT INTO tbl_order(order_code,product_id,product_quantity, hoten,dienthoai,diachi,method)
            VALUES ('$order_code','$product_id','$product_quantity','$hoten','$dienthoai','$diachi','$method')";
            $result = $this->pdo_execute($query);
           }
        }   
        return $result;
    }
}
?>