<?php 
    include('class.php');
    $oBj = new Main;
    $listPoActivate = $oBj->listPoActivate();
    echo "
    <a href='stockProduct.php'><button type='button'>สต็อกสินค้า</button></a>
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <a href='getProduct.php'><button type='button'>รับสินค้า</button></a>
    <h1> รับสินค้าเข้าคลัง </h1>
    <hr>
    รายการใบสั่งซื้อที่อนุมัติแล้ว
    <table border='0' width='500'>
                
                
    <tr>
        <td>รหัส</td>
        <td>ชื่อลูกค้า </td>
        <td>วันที่ออก </td>
        <td>มูลค่า</td>
        <td></td>
    </tr>
";
    for($i = 0 ; $i < count($listPoActivate) ; $i++){
    $buy_ids = $listPoActivate[$i]['buy_id'];
    echo "
    <tr>
        <td> <a href='listPoDetail.php?buyid=". $buy_ids ."'> ". $buy_ids ." </a> </td>
        <td> ". $listPoActivate[$i]['supplier_desc'] ." </td>
        <td> ". $listPoActivate[$i]['buy_date'] ." </td>
        <td> ". $oBj->costPo($buy_ids) ." </td>
        <td>             

    ";
    if($oBj->checkRecv($buy_ids) == 1){
        echo "รับสินค้าแล้ว";
    }else {
        echo "<a href='getProductDetail.php?buyid=".$buy_ids."'><button type='button'>รับสินค้า</button></a>";
    };
    echo "
        </td>
    </tr>
    ";
    };
    echo "
    </table>
    ";

?>