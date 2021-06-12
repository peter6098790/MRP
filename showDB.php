<?php
	require('dbconfig.php');
	require('model.php');
	
    #$result=readProduct(14) ;
    
    #echo $name
    #createProductName('test123');
    #deleteProduct(9);
    #createProduct('test145',15,3,5,null,null)
    #updateProduct('test1456',15,3,5,null,null,13)
    $result = readAllData();
    // while($rs =mysqli_fetch_assoc($result)){
    //     $name=$rs['pname'];
    //     echo $name;
    //     echo "<br/>";
    // }
    if ($result -> num_rows == 0){
        echo '目前無資料';
    }else{
        while($rs =mysqli_fetch_assoc($result)){
            $name=$rs['pname'];
            $stock=$rs['stock'];
            echo $name.'剩餘庫存: '.$stock;
            echo "<br/>";
        }
    }
    // var_dump($result);
    // if($nums > 0){
    //     while($row=mysql_fetch_array($result)){
    //         $id=$row['id'];
    //     }
    //     echo $id;
    // }else{
    //     $id = 0;
    // }
    
    // while($rs =mysqli_fetch_assoc($result)){
    //     $id=$rs['id'];
    // }
    // echo $id;
    #var_dump($result);
    // if ($result = 'NULL'){
    //     echo 'null';
    // }else{
    //     while($rs =mysqli_fetch_assoc($result)){
    //         $id=$rs['id'];
    //     }
    //     echo $id;
    // }
    #echo $rs['name']
    #var_dump($rs);
?>