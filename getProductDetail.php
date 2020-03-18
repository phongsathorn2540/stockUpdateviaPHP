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
        <h1> รับสินค้า </h1>
        <hr>
    ";
    if($buyid != 0){
        echo "
        <form action='' method='get'>
        <input type='text' value='".$buyid."' name='buyid' hidden>
        
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
                        <td>จำนวนที่สัง</td>
                        <td style='text-align: right;'>จำนวนที่ได้</td>
                    </tr>
        ";
        for($i = 0 ; count($data) > $i ; $i++){
        echo "
            <tr>
            <td>" . $data[$i]['prod_id'] ."</td>
            <td>" . $data[$i]['prod_desc'] ."</td>
            <td>" . $data[$i]['order_amount'] ."</td>
            <td> 
            ";
            if($oBj->checkRecv($buyid) == 1){
                echo "รับสินค้าแล้ว";
            }else{
                echo "<input type='number' name='amount".$i."' min='0'  required>";
            };
            echo "
            </td>
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
                            <input type='text' value='".$buyid."' name='formpost' hidden>
                            ";
                            if($oBj->checkRecv($buyid) == 1){
                            }else{
                                echo "<input type='submit' value='รับสินค้า'>";
                            }
                            echo "
                            </form>
        ";
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
    if(isset($_GET['formpost'])){
        for($is = 0 ; count($data) > $is ; $is++){
            $prod_id = $data[$is]['prod_id'];
            $order_amout = $_GET['amount'.$is];
            echo $oBj->getProduct($prod_id , $order_amout , $buyid);
        }
    echo $oBj->updateDateRecv($buyid);
    };

?>