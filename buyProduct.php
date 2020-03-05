<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();

    echo "
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <button type='button'>รับสินค้า</button>
        <h1> สั่งซื้อ Product </h1>
        <br>
        <form action='buyProduct.php' method='post'>
        <table>
            <tr>
                <td>
                    เลือก supplier   
                </td>
                <td>
                    <select name='supplier'>           
    ";
                    for($i = 0 ; $i < count($data) ; $i++){
                        echo "<option value='". $data[$i]['supplier_id'] ."'> ". $data[$i]['supplier_desc'] ." </option>";
                    }
    echo " </select> <button type='submit' value='submit'>เลือก</button> </form></td> </tr>";
    if(isset($_POST["supplier"])){
        $sup_id = $_POST["supplier"];
        $dataProductbyid = $oBj->showBuyproduct($sup_id);
        echo "
        <form action='buyProduct.php' method='post'>
            <tr>
                <td>
                    วันที่ออก
                </td>
                <td>
                    <input type='date' name='dateofbill' required>
                </td>
            </tr>
            <tr>
            <td>
                วันที่จะชำระ
            </td>
            <td>
                <input type='date' name='dateofpay' required>
            </td>
        </tr>
            <tr>
                <td>
                    ชื่อสินค้า
                </td>
                <td>
                    จำนวน
                </td>
            </tr>
        ";
        for($i = 0 ; $i < count($dataProductbyid) ; $i++){
            echo "
                <tr>
                    <td>
                         " . $dataProductbyid[$i]['prod_desc'] . "
                    </td>
                    <td>
                        <input type='number' name='amount".$i."' min='0' required>
                    </td>
                </tr>   
            ";
        }
        echo "
        </table>
        <button type='submit' value='submit'>สั่งซื้อ</button>
        ";
        if(isset($_POST['dateofbill'])){
            $buyid = $oBj->showBuyid(); //last buy id
            $dateofbill = $_POST['dateofbill'];
            $dateofpay = $_POST['dateofpay'];
            echo $oBj->addBuy($sup_id, $dateofbill, $dateofpay);
            for($ii = 0 ; $ii < count($dataProductbyid) ; $ii++){
                $prod_amout = $_POST['amount'.$ii];
                echo $oBj->addBuydesc($buyid, $dataProductbyid[$ii]['prod_id'], $prod_amout);
            }
        }
    }
?>