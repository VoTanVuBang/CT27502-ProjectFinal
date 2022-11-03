<?php
include "./config.php";
?>



<?php
// class Database
// {
//     public $host = DB_HOST;
//     public $user = DB_USER;
//     public $pass = DB_PASS;
//     public $dbname = DB_NAME;

//     public $link;
//     public $error;

//     public function __construct()
//     {
//         $this->connectDB();
//     }

//     private function connectDB()
//     {
//         $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
//         if (!$this->link) {
//             $this->error = "Connection fail" . $this->link->connect_error;
//             return false;
//         }
//     }

//     //Select or Read data
//     public function select($query)
//     {
//         $result = $this->link->query($query) or
//             die($this->link->error . __LINE__);
//         if ($result->num_rows > 0) {
//             return $result;
//         } else {
//             return false;
//         }
//     }

//     //Insert data
//     public function insert($query)
//     {
//         $insert_row = $this->link->query($query) or
//             die($this->link->error . __LINE__);
//         if ($insert_row) {
//             return $insert_row;
//         } else {
//             return false;
//         }
//     }

//     //Update data
//     public function update($query)
//     {
//         $update_row = $this->link->query($query) or
//             die($this->link->error . __LINE__);
//         if ($update_row) {
//             return $update_row;
//         } else {
//             return false;
//         }
//     }

//     //Delete data
//     public function delete($query)
//     {
//         $delete_row = $this->link->query($query) or
//             die($this->link->error . __LINE__);
//         if ($delete_row) {
//             return $delete_row;
//         } else {
//             return false;
//         }
//     }
// }

class DB
{
    public $conn;
    public $servername = DB_HOST;
    public $username = DB_USER;
    public $password = DB_PASS;
    public $dbname = DB_NAME;

    function __construct()
    {
        $dburl = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=utf8";

        $this->conn = new PDO($dburl, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // return $this->conn;
    }
    /**
     * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_execute($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            // $this->conn = pdo_get_connection();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            return true;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            // unset($this->conn);
        }
    }
    function pdo_execute_lastInsertID($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            // $this->conn = pdo_get_connection();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        } finally {
            // unset($this->conn);
        }
    }
    /**
     * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return array mảng các bản ghi
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            // $this->conn = pdo_get_connection();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            // unset($this->conn);
        }
    }
    /**
     * Thực thi câu lệnh sql truy vấn một bản ghi
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return array mảng chứa bản ghi
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query_one($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            // $this->conn = pdo_get_connection();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            // unset($this->conn);
        }
    }
    /**
     * Thực thi câu lệnh sql truy vấn một giá trị
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return giá trị
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query_value($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            // $this->conn = pdo_get_connection();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }
}

?>
