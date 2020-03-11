<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    $sup_id = '';
    $listPo = $oBj->listPo();
    echo "
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <button type='button'>รับสินค้า</button>
        <h1> รายการใบสั่งซื้อ </h1>
        <hr>
    <table border='1'>
        <tr>
            <td>รหัส</td>
            <td>ชื่อลูกค้า </td>
            <td>วันที่ออก </td>
            <td>มูลค่า</td>
            <td>สถานะ</td>
        </tr>
    ";
    for($i = 0 ; $i < count($listPo) ; $i++){
        $sumCost = 0;
        echo "
        <tr>
            <td> ". $listPo[$i]['buy_id'] ." </td>
            <td> ". $listPo[$i]['supplier_desc'] ." </td>
            <td> ". $listPo[$i]['buy_date'] ." </td>
            <td> ". $sumCost." </td>
            <td> </td>
        </tr>
        ";
    }
?>