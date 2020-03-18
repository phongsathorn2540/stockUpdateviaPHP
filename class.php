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
                $data = $row['max(buy_id)'];
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
        public function listPoActivate(){
            $sql = "SELECT buy_id , supplier_desc , buy_date FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id
            WHERE buy_status = 2";
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

            $costPo = 0;
            for($i = 0 ; count($data) > $i ; $i++){
                $costPo += ($data[$i]['order_amount'] * $data[$i]['prod_cost']);
            }
            return $costPo;
        }
        public function getStatusPo($buy_id){
            $sql = "SELECT buy_status_desc FROM `buy_status_desc` INNER JOIN buy on buy.buy_status = buy_status_desc.buy_status WHERE buy.buy_id = $buy_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['buy_status_desc'];
            }
            return $data;
        }
        public function getNameSupplier($buyid){
            $sql = "SELECT supplier_desc FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['supplier_desc'];
            }
            return $data;
        }
        public function getDatebuy($buyid){
            $sql = "SELECT buy_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['buy_date'];
            }
            return $data;
        }
        public function detailBill($buyid){
            $sql = "SELECT buy_desc.prod_id , product.prod_desc , order_amount, (order_amount * product.prod_cost)  FROM buy_desc INNER JOIN product on product.prod_id = buy_desc.prod_id WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function activateBill($buyid){
            $sql = "UPDATE buy SET buy_status = '2' WHERE buy_id = $buyid";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function payBill($buyid){
            $d = strtotime("tomorrow");
            $datenow = date("Y-m-d", $d);
            $sql = "UPDATE buy SET pay_date ='$datenow' WHERE buy_id = $buyid";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkPay($buyid){
            $sql = "SELECT pay_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['pay_date'];
            }
            if($data == NULL){
                return 0;
            }else {
                return 1;
            }
        }
        public function getPoStock($prod_id){
            $sql = "SELECT total FROM product_stock WHERE prod_id = $prod_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $total = $row['total'];
            }
            return $total;
        }
        public function getProduct($prod_id , $amount){
            $amount = $this->getPoStock($prod_id) + $amount;
            $sql = "UPDATE product_stock SET total = '$amount' WHERE prod_id = $prod_id";
            
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function updateDateRecv($buy_id){
            $d = strtotime("tomorrow");
            $datenow = date("Y-m-d", $d);
            $sql = "UPDATE buy SET recv_date = '$datenow' WHERE buy_id = $buy_id";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkRecv($buyid){
            $sql = "SELECT recv_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['recv_date'];
            }
            if($data == NULL){
                return 0;
            }else {
                return 1;
            }
        }
        public function stockProduct(){
            $sql = "SELECT product_stock.prod_id , product.prod_desc , branch.branch_name , branch.branch_location , total FROM `product_stock` INNER JOIN product on product_stock.prod_id = product.prod_id INNER JOIN branch on product_stock.branch_id = branch.branch_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        
    }
?>