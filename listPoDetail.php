<?php 
    include('class.php');
    $oBj = new Main;
    $buyid = 0;
    if(isset($_GET['buyid'])){
        $buyid = $_GET['buyid'];
    };
    $data = $oBj->detailBill($buyid);
    echo "
    <a href='stockProduct.php'><button type='button'>สต็อกสินค้า</button></a>
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <a href='getProduct.php'><button type='button'>รับสินค้า</button></a>
        <h1> รายการใบสั่งซื้อ </h1>
        <hr>
    ";
    if($buyid != 0){
        echo "
        <table>
        <tr style='background-color:lightblue'>
            <td>
                ใบสั่งซื้อเลขที่ " . $buyid . " "  . $oBj->getStatusPo($buyid) . "
            </td>
            
        </tr>
        <tr>
            <td>
                <table width='100%'>
                    <tr>
                        <td>
                            ผู้ขาย " . $oBj->getNameSupplier($buyid) . "
                        </td>
                        <td>
                            วันที่ออก " . $oBj->getDatebuy($buyid) . "
                        </td>
                        <td>
                            ยอดรวมสุทธิ " . $oBj->costPo($buyid) . " บาท
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width='100%'>
                    <tr>
                        <td>รหัสสินค้า</td>
                        <td>ชื่อสินค้า</td>
                        <td>จำนวน</td>
                        <td style='text-align: right;'>ราคา</td>
                    </tr>
        ";
        for($i = 0 ; count($data) > $i ; $i++){
        echo "
            <tr>
            <td>" . $data[$i]['prod_id'] ."</td>
            <td>" . $data[$i]['prod_desc'] ."</td>
            <td>" . $data[$i]['order_amount'] ."</td>
            <td style='text-align: right;'>" . $data[$i]['(order_amount * product.prod_cost)'] ."</td>
            </tr>
        ";
        }
        echo "
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width='100%'>
                    <tr>
                        <td style='text-align: right;'>
                            <b>ยอดรวมสุทธิ</b>
                            <br>
                            " . $oBj->costPo($buyid) . " บาท
                            <br>
        ";
        if($oBj->checkPay($buyid) == 0){
            echo "
                <form action='' method='POST'>
                    <input type='text' name='idtoupdate' value='".$buyid."' hidden>
                    <input type='submit' value='ชำระค่าบริการ'>
                </form>            
            ";
        }else if($oBj->getStatusPo($buyid) == "รออนุมัติ"){
            echo "
            ชำระค่าสินค้าแล้ว
            <form action='' method='POST'>
            <input type='text' name='activateBill' value='".$buyid."' hidden>
            <input type='submit' value='อนุมัติรายการ'>
            </form> 
            
            ";
        }else {
            echo "
            ชำระค่าสินค้าแล้ว <br>
            อนุมัติรายการแล้ว
            ";
        }
        if(isset($_POST['idtoupdate'])){
            echo $oBj->payBill($buyid);
        }
        if(isset($_POST['activateBill'])){
            echo $oBj->activateBill($buyid);
        }
        echo "
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    ";
    }else{
        echo "fail";
    }

?>