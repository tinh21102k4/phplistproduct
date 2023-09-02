<?php
require_once "../connection.php";

$id = $_GET['id'];
$sql = "DELETE FROM product where id=$id";

$stmt = $conn->prepare($sql);
$stmt->execute();

$message = "ban da xoa san pham thanh cong";
header("location: list_product.php?message= ".$message);
die;
?>