<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/../database.php');
?>

<?php
    class cartegory extends DB{
        

        public function insert_cartegory($cartegory_name){
            $query = "INSERT INTO tbl_cartegory (cartegory_name) VALUES ('$cartegory_name') ";
            
            $stmt = $this->pdo_execute($query);
            header('Location:cartegory-list.php');
            return $stmt;
        }

        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
            $stmt = $this->pdo_query($query);
            return $stmt;
        }

        public function  get_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
            $stmt = $this->pdo_query($query);
            return  $stmt;
        }

        public function update_cartegory($cartegory_name,$cartegory_id){
            $query = "UPDATE tbl_cartegory SET cartegory_name='$cartegory_name' WHERE cartegory_id = '$cartegory_id' ";
            $stmt = $this->pdo_execute($query);
            header('Location: cartegory-list.php');
            return  $stmt;
        }

        public function delete_cartegory($cartegory_id){
            $query = "DELETE FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id' ";
            $stmt = $this->pdo_execute($query);
            header('Location: cartegory-list.php');
            return  $stmt;
        }
    }
?>