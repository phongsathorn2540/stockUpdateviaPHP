<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showProduct();
    echo "
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <button type='button'>รับสินค้า</button>
    <br>
    <table border='1'>
    <tr>
        <td>
            รหัส
        </td>
        <td>
            ชื่อสินค้า
        </td>
        <td>
            ราคาซื้อ
        </td>
        <td>
            ราคาขาย
        </td>
        <td>
            จำนวนคงเหลือ
        </td>
    </tr>         
    " ;
    for($i = 0 ; $i < count($data) ; $i++){
        echo "
        <tr>
            <td>
                " .$data[$i]['prod_id']. "
            </td>
            <td>
                " .$data[$i]['prod_desc']. "
            </td>
            <td>
                " .$data[$i]['prod_cost']. "
            </td>
            <td>
                " .$data[$i]['prod_price']. "
            </td>
            <td>
                " .$data[$i]['total']. "
            </td>
        </tr>         
        " ;
    }
    echo "</table>";
 //   echo "<pre>";
   // print_r($data);
    //  echo "</pre>";
?>