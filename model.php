<?php
error_reporting(E_ALL || ~E_NOTICE);
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
//新增零件至資料庫
function createProduct($pname,$stock,$leadtime,$material_name,$material_qty) #,$level
{
    global $db;
    $sql =  "INSERT INTO product (pname,stock,leadtime,material_name,material_qty) VALUES (?,?,?,?,?)"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "siiss", $pname,$stock,$leadtime,$material_name,$material_qty); #,$level
    mysqli_stmt_execute($stmt);
}
//更新現有零件
function updateProduct($pname,$stock,$leadtime,$material_name,$material_qty,$id) #,$level
{
    global $db;
    $sql =  "UPDATE product SET pname = ? ,stock = ?  ,leadtime = ? ,material_name = ? ,material_qty = ? where id = ?"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "siissi", $pname,$stock,$leadtime,$material_name,$material_qty,$id);
    mysqli_stmt_execute($stmt);
}
function updateProductStock($pname,$stock)
{
    global $db;
    $sql =  "UPDATE product SET stock = ? where pname = ?"; 
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "is", $stock,$pname);
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
//用零件名稱找資料庫id
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
function readAllProduct()
{
    global $db;
    $sql = "SELECT pname,stock,material_name,material_qty FROM `product` where 1" ;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
//顯示庫存列表
function showAllProduct(){
    $result=readAllProduct();
    while($rs = mysqli_fetch_assoc($result)){
        echo"<tr><td colspan='4'><hr></td></tr> ";
        echo"<tr><td>";
        echo $rs['pname'];
        echo"</td><td>";
        echo $rs['stock'];
        echo"</td><td>";
        echo $rs['material_name'];
        echo"</td><td>";
        echo $rs['material_qty'];
        echo"</td></tr>";
    }
}
//取得子零件和數量
function getSubProduct($pname)
{
    global $db;
    $sql = "SELECT material_name FROM `product` where pname = ?" ;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $pname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function getleadtime($pname)
{
    global $db;
    $sql = "SELECT leadtime FROM `product` where pname = ?" ;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $pname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function calculate($target){ #,$week,$demand
    $result=getleadtime($target);
    while($rs = mysqli_fetch_assoc($result)){
        $leadtime = $rs['leadtime'];
    }
    //周次-leadtime $week-$leadtime;
    //demand *
    //while arr !null 

//刪除unset($
}
?>