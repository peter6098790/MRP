<?php
	require('dbconfig.php');
	require('model.php');
	
    $result=readProduct(14) ;
    while($rs =mysqli_fetch_assoc($result)){
        $name=$rs['pname'];
    }
    echo $name
    #createProductName('test123');
    #deleteProduct(9);
    #createProduct('test145',15,3,5,null,null)
    #updateProduct('test1456',15,3,5,null,null,13)
    
    #echo $rs['name']
    #var_dump($rs);
?>