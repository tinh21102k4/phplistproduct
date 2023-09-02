<?php
session_start();
require_once"../connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username == '')
    {
        $errors['username'] = "username khong duoc de trong";
    }else
    {
        // so sanh trong sql 
        $sql = "SELECT * FROM users where username = '$username'";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            // kiem tra mat khau 
            if($user['password'] == $password)
            {
                // dang nhap thanh cong , luu lai thongtin user vao session
                $_SESSION['username'] = $username;
                header("location: list_product.php");
                die;
            }
            else{
                $errors['password'] = "mat khau khong dung";
            }
           
        }
        else{
            $errors['username'] = "mat khau khong dung";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        username : <br>
        <input type="text" name="username" id=""> <br>
        <span style="color: red;">
            <?= $errors['username']?? '' ?>
        </span>
        <br>
        password : <br>
        <input type="password" name="password" id=""> <br>
        <span style="color: red;">
            <?= $errors['password']?? '' ?>
        </span>
        <input type="submit" value="dang nhap">
    </form>
</body>
</html>