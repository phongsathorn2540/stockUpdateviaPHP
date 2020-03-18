<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->stockProduct();
    echo "
    <a href='stockProduct.php'><button type='button'>สต็อกสินค้า</button></a>
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <a href='getProduct.php'><button type='button'>รับสินค้า</button></a>
        <h1> รายการใบสั่งซื้อ </h1>
        <hr>
    <table border='0' width='500'>
        <tr>
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า </td>
            <td>สาขา</td>
            <td>จำนวน</td>
        </tr>
    ";
    for($i = 0 ; $i < count($data) ; $i++){
        echo "
        <tr>
            <td> ". $data[$i]['prod_id'] ." </td>
            <td> ". $data[$i]['prod_desc'] ." </td>
            <td> ". $data[$i]['branch_name'] ." </td>
            <td> ". $data[$i]['total'] ." </td>
        </tr>
        ";
    }
?>