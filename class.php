<?php
    class Database{
        protected $host = 'localhost';
        protected $db = 'stockupdate';
        protected $user = 'root';
        protected $pass = '';
        public function db_con(){
            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            if ($conn->connect_error) {
                return die("Connection failed: " . $conn->connect_error);
            }else {
                return $conn;
            }
        }
    }
    class Main extends Database{
        public function showProduct(){
            $sql = "SELECT product.prod_id, product.prod_desc, product.prod_cost, product.prod_price, product_stock.total 
                    FROM product 
                    INNER JOIN product_stock ON product.prod_id = product_stock.prod_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function addProduct($supplier , $prod_desc , $prod_cost , $prod_price){
            $sql = "INSERT INTO `product` (`prod_id`, `supplier_id`, `prod_desc`, `prod_cost`, `prod_price`) VALUES (NULL, '$supplier', '$prod_desc', '$prod_cost', '$prod_price');";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function showSupplier(){
            $sql = "SELECT supplier_id , supplier_desc FROM supplier";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function addSupplier($name){
            $sql = "INSERT INTO supplier (supplier_desc) values ('$name')";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
    }
?>