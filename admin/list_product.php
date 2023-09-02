<?php 
    session_start();
    require_once"../connection.php";
    // kiem tra xem usernaem da dang nhap chua
    if(!isset($_SESSION['username']))
    {
        header('location: login.php');
        die;
    }

    // sql table product
    $sql = "select * from product";
    // chuan bi
    $stmt = $conn->prepare($sql);
    // thuc thi
    $stmt ->execute();
    //lay tat ca du lieu (tat ca san pham)
    $product = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>danh sach san pham</title>
</head>
<body>
    <div style="color:green">
        <?=$_GET['message']??''?>    
</div>
    <table border="1">
        <tr>
            <th>#ID</th>
            <th>ten san pham</th>
            <th>hinh anh</th>
            <th>gia </th>
            <th>so luong</th>
            <th>
                <a href="add_product.php"> them </a>
            </th>

        </tr>

        <?php foreach ($product as $pro) : ?>
        <tr>
            <td><?= $pro['ID'] ?></td>
            <td><?= $pro['product_name'] ?></td>
            <td>
                <img src="../image/<?= $pro['image'] ?>" width="120" alt="">
            </td>
            <td><?= $pro['price']?></td>
            <td><?= $pro['quantity']?></td>
            <td>
                <!-- sua du lieu -->
                <a href="edit_product.php?id=<?=$pro['ID']?>">sua </a>
                <!-- xoa du lieu -->
                <a onclick="return confirm('ban co chac chan muon xoa khong ?');"
                 href="dellete_product.php?id=<?=$pro['ID']?>">xoa</a>
            </td>
        </tr>
        <!-- cau lenh xoa -->

    <?php endforeach ?>
    </table>
    
</body>
</html>