<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbName = 'mrp';
    $db = mysqli_connect($host, $user, $pass, $dbName) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
    mysqli_query($db,"SET NAMES utf8"); //選擇編碼
    //檢查連線是否成功
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
      #echo "Connected successfully";
?>