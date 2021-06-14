<?php
	require('dbconfig.php');
	require('model.php');
    $result = getSubProduct('E');

    while($rs =mysqli_fetch_assoc($result)){
        $material_name=$rs['material_name'];
        echo $material_name;
        echo "<br/>";
    }
?>