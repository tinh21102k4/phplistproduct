<?php
// ket noi den co so du lieu de lamf viec
// thong tin cua csdl
$host = "localhost";
$dbname = "wd18318_php";
$usernamemaychu = "root";
$password ="";

// ket noi 
try 
{
    // code 
    $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $usernamemaychu, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e)
{
    echo"loi ket noi co so du lieu :" .$e-> getMessage();
}