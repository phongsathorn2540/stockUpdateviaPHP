<?php 
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        include('class.php');
        $oBj = new Main;
        echo $oBj->addSupplier($name);
    };
    echo "
    <a href='stockProduct.php'><button type='button'>สต็อกสินค้า</button></a>
    <a href='addProduct.php'><button type='button'>เพิ่มสินค้า</button></a>
    <a href='addSup.php'><button type='button'>เพิ่ม supplier</button></a>
    <a href='buyProduct.php'><button type='button'>สั่งซื้อสินค้า</button></a>
    <a href='listPo.php'><button type='button'>รายการใบสั่งซื้อ</button></a>
    <a href='getProduct.php'><button type='button'>รับสินค้า</button></a>
        <h1> เพิ่ม supplier </h1>
        <br>
        <form action='addSup.php' method='post'>
        <table>
            <tr>
                <td>
                    ชื่อ supplier 
                </td>
                <td>
                    <input type='text' name='name' placeholder='ชื่อ supplier' required>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button type='submit' value='submit'>เพิ่ม</button>
                </td>
            </tr>
        </table>
        </form>
    ";
?>