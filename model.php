<?php
require_once("dbconfig.php");

function readAllData() 
{
    global $db;
    $sql = "SELECT * FROM `product`" ; #WHERE tgame.go=-1 AND (r1=? OR r2=? OR r3=? OR r4=?) ORDER BY totalcost ASC";
    $stmt = mysqli_prepare($db, $sql);
    #mysqli_stmt_bind_param($stmt, "ssss", $id,$id,$id,$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function readProduct($id)
{
    global $db;
    $sql = "SELECT * FROM `product` where id = ?" ;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
    #echo $result;
}

function createProduct($pname,$stock,$level,$leadtime,$material_name,$material_qty)
{
    global $db;
    $sql =  "INSERT INTO product (pname,stock,plevel,leadtime,material_name,material_qty) VALUES (?,?,?,?,?,?)"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "siiiss", $pname,$stock,$level,$leadtime,$material_name,$material_qty);
    mysqli_stmt_execute($stmt);
}
function updateProduct($pname,$stock,$level,$leadtime,$material_name,$material_qty,$id)
{
    global $db;
    $sql =  "UPDATE product SET pname = ? ,stock = ? ,plevel = ? ,leadtime = ? ,material_name = ? ,material_qty = ? where id = ?"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "siiissi", $pname,$stock,$level,$leadtime,$material_name,$material_qty,$id);
    mysqli_stmt_execute($stmt);
}


function deleteProduct($id)
{
    global $db;
    $sql =  "DELETE FROM product where id = ?"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i",$id);
    mysqli_stmt_execute($stmt);
}

function getProductID($pname){
    global $db;
    $sql =  "SELECT id FROM product where pname = ?"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s",$pname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
    #echo $result['id'];
}
?>