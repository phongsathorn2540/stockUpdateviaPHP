<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    $sup_id = '';
    echo "
    <a href='stockProduct.php'><button type='button'>สต็อกสินค้า</button></a>
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <a href='getProduct.php'><button type='button'>รับสินค้า</button></a>
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
        <form action='buyProduct.php' method='get'>
            <tr>
                <td>
                    วันที่ออก
                </td>
                <td>
                    <input type='text' name='supplier' value='$sup_id' hidden>
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
        </form>
        ";
    }
    if(isset($_GET['dateofbill'])){
        $sup_id = $_GET["supplier"];
        $dataProductbyid = $oBj->showBuyproduct($sup_id);
        $dateofbill = $_GET['dateofbill'];
        $dateofpay = $_GET['dateofpay'];
        echo $oBj->addBuy($sup_id, $dateofbill, $dateofpay);
        $buyid = $oBj->showBuyid(); //last buy id
        for($ii = 0 ; $ii < count($dataProductbyid) ; $ii++){
            $prod_id = $dataProductbyid[$ii]['prod_id'];
            $order_amout = $_GET['amount'.$ii];
            echo $oBj->addBuydesc($buyid, $prod_id , $order_amout);
        }
    }
?>