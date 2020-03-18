<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    $sup_id = '';
    $listPo = $oBj->listPo();
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
            <td>รหัส</td>
            <td>ชื่อลูกค้า </td>
            <td>วันที่ออก </td>
            <td>มูลค่า</td>
            <td>สถานะ</td>
        </tr>
    ";
    for($i = 0 ; $i < count($listPo) ; $i++){
        $buy_ids = $listPo[$i]['buy_id'];
        echo "
        <tr>
            <td> <a href='listPoDetail.php?buyid=". $buy_ids ."'> ". $buy_ids ." </a> </td>
            <td> ". $listPo[$i]['supplier_desc'] ." </td>
            <td> ". $listPo[$i]['buy_date'] ." </td>
            <td> ". $oBj->costPo($buy_ids) ." </td>
            <td> " . $oBj->getStatusPo($buy_ids) . " </td>
        </tr>
        ";
    }
?>