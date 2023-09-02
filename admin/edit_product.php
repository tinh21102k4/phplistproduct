<?php 
 require_once "../connection.php";
 // kiem tra xem da gui du lieu len server chua
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $product_name = $_POST['product_name'];
    $price= $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $category_id= $_POST['category_id'];

    // 
    $id = $_POST['id'];
    $image = $_POST['image']; // ten anh cu
    // su ly file
    $file = $_FILES['image'];
    // cap nhat anh moi
    if($file['size']>0)
    {
       // lay ten anh
    $image = $file['name'];
    // upload acctualy di chuyen anh sang muc image 
    move_uploaded_file($file['tmp_name'],"../image/" . $image);
    }

    
   
    // sql insert into them cot cua sql
    $sql = "UPDATE product SET product_name='$product_name', image='$image' , price='$price', quantity='$quantity', description='$description', category_id ='$category_id' where id=$id";
    // chuan bi
    $stmt = $conn->prepare($sql);
    // thuc thi
    $stmt ->execute();
// hien thi thanh cong
    $message = "chuc mung ban da cap nhat du lieu thanh cong";
}
//  lay du lieu tu bang category
$sql = " SELECT * FROM category";
// chuan bi
$stmt = $conn -> prepare($sql);
// thuc thi
$stmt->execute();
// lay du lieu 
$category = $stmt->fetchAll(PDO::FETCH_ASSOC);

// lay thong tin cua id 
$id = $_GET['id'];
// sql 
$sql = "SELECT * FROM product WHERE ID=$id";
// chuan bi
$stmt = $conn->prepare($sql);
// thuc thi
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>them san pham</title>
</head>
<body>
    <section class="" style="color: green;">
        <?=$message?? ''?>
    </section>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$product['ID'] ?>">
        <input type="text" name="product_name" placeholder="ten san pham" value="<?=$product['product_name'] ?>">
        <br>
        <input type="file" name="image" id="">
        <input type="hidden" name="image" value="<?=$product['image'] ?>">
        <!-- hien thi hinh anh cu cho nguoi ta nhin thay -->
        <img src="../image/<?=$product['image']?>" width="120" alt="">
        <br>
        <input type="number" name="price" id="" placeholder="gia" value="<?=$product['price'] ?>">
        <br>
        <input type="number" name="quantity" id="" placeholder="so luong" value="<?=$product['quantity'] ?>">
        <br>
        <textarea name="description" id="" cols="100" rows="6" placeholder="mo ta" value="<?=$product['description'] ?>" ></textarea>
        <br>
         <select name="category_id" id="">
            <?php foreach($category as $cate) :?>
                <!-- so sanh voi san pham -->
                <option value=" <?= $cate['id'] ?>" <?= ($cate['id']== $product['category_id'])? 'slected':''?>>

                <?= $cate['NAME'] ?>
                </option>
            <?php endforeach ?>
         </select>
         <br>
         <button type="submit">uppdate product</button>
         <a href="list_product.php">Danh sach</a>
    </form>
</body>
</html>