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
    // su ly file
    $file = $_FILES['image'];
    // lay ten anh4
    $image = $file['name'];
    // upload acctualy di chuyen anh sang muc image 
    move_uploaded_file($file['tmp_name'],"../image/" . $image);
    // sql insert into them cot cua sql
    $sql = "insert into product(product_name, image , price, quantity, description, category_id) VALUES
     ('$product_name', '$image' , '$price', '$quantity', '$description',' $category_id')";
    // chuan bi
    $stmt = $conn->prepare($sql);
    // thuc thi
    $stmt ->execute();
}
//  lay du lieu tu bang category
$sql = " SELECT * FROM category";
// chuan bi
$stmt = $conn -> prepare($sql);
// thuc thi
$stmt->execute();
// lay du lieu 
$category = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>them san pham</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="product_name" placeholder="ten san pham">
        <br>
        <input type="file" name="image" id="">
        <br>
        <input type="number" name="price" id="" placeholder="gia">
        <br>
        <input type="number" name="quantity" id="" placeholder="so luong">
        <br>
        <textarea name="description" id="" cols="100" rows="6" placeholder="mo ta" ></textarea>
         <br>
         <select name="category_id" id="">
            <?php foreach($category as $cate) :?>
                <option value="<?= $cate['id'] ?> ">
                <?= $cate['NAME'] ?>
                </option>
            <?php endforeach ?>
         </select>
         <br>
         <button type="submit"> them san pham</button>
         <a href="./list_product.php">tro lai danh sach</a>
    </form>
</body>
</html>