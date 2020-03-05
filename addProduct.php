<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    if(isset($_GET["supplier"])){
        $supplier = $_GET["supplier"];
        $name = $_GET["name"];
        $cost = $_GET["cost"];
        $price = $_GET["price"];
        echo $oBj->addProduct($supplier , $name , $cost , $price);
    };

    echo "
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <button type='button'>รับสินค้า</button>
        <h1> เพิ่ม Product </h1>
        <br>
        <form action='addProduct.php' method='get'>
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
    echo "          </select>
                </td>
            <tr>
                <td>
                    ชื่อสินค้า
                </td>
                <td>
                    <input type='text' name='name' placeholder='ชื่อสินค้า' required>
                </td>
            </tr>
                    
            <tr>
            <td>
                ราคาซื้อ
            </td>
            <td>
                <input type='text' name='cost' placeholder='ราคาซื้อ' required>
            </td>
        </tr>
        <tr>
        <td>
            ราคาขาย
        </td>
        <td>
            <input type='text' name='price' placeholder='ราคาขาย' required>
        </td>
    </tr>
    </table>
    <button type='submit' value='submit'>เพิ่ม</button>
    </form>
    ";
?>