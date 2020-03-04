<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    if(isset($_POST["supplier"])){
        $supplier = $_POST["supplier"];
        $name = $_POST["name"];
        $cost = $_POST["cost"];
        $price = $_POST["price"];
        echo $oBj->addProduct($supplier , $name , $cost , $price);
    };

    echo "
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
    echo "          </select>
                </td>
            <tr>
                <td>
                    ชื่อสินค้า
                </td>
                <td>
                    <input type='text' name='name' placeholder='ชื่อสินค้า'>
                </td>
            </tr>
                    
            <tr>
            <td>
                ราคาซื้อ
            </td>
            <td>
                <input type='text' name='cost' placeholder='ราคาซื้อ'>
            </td>
        </tr>
        <tr>
        <td>
            ราคาขาย
        </td>
        <td>
            <input type='text' name='price' placeholder='ราคาขาย'>
        </td>
    </tr>
    </table>
    <button type='submit' value='submit'>เพิ่ม</button>
    </form>
    ";
?>