<?php
    require_once "connection.php";

    // sql
    $sql = "select * from category";
    // chuan bi
    $stmt = $conn -> prepare($sql);
    // thuc thi 
    $stmt-> execute();
    // lay du lieu
    
    $category = $stmt -> fetchAll();
    echo"<pre>";
    var_dump($category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

    
</body>
</html>
<!-- cái này là xuất các phần tử mảng của phần categorry nhé chứ không phải là kết nối hay cái gì đâu  -->