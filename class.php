<?php
    class Database{
        protected $host = 'localhost';
        protected $db = 'stockupdate';
        protected $user = 'root';
        protected $pass = '';
        public function db_con(){
            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            $conn -> set_charset("utf8");
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
        public function showBuyproduct($sup_id){
            $sql = "SELECT prod_id, prod_desc FROM product WHERE supplier_id = $sup_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function showBuyid(){
            $sql = "SELECT max(buy_id) FROM buy";
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
        public function addBuy($sup_id, $dateofbill, $dateofpay){
            $sql = "INSERT INTO `buy` (`buy_id`, `supplier_id`, `buy_date`, `buy_status`, `recv_date`, `due_pay_date`, `pay_date`) VALUES (NULL, '$sup_id', '$dateofbill', '1', NULL, '$dateofpay', NULL)";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function addBuydesc($buy_id , $prod_id , $order_amount){
            $sql = "INSERT INTO `buy_desc` (`id`, `buy_id`, `prod_id`, `order_amount`, `recv_amount`) VALUES (NULL, '$buy_id', '$prod_id', '$order_amount', NULL)";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function listPo(){
            $sql = "SELECT buy_id , supplier_desc , buy_date FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function costPo($buy_id){
            $sql = "SELECT product.prod_id , order_amount , product.prod_cost 
            FROM buy_desc 
            INNER JOIN product on buy_desc.prod_id = product.prod_id 
            WHERE buy_id = $buy_id
            ";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }
?>