<?php 
require('dbconfig.php');
require('insertView.php');
require('model.php');

$counter = 0;
// foreach ($_POST as $key => $value) {
//         $$key=$value; 
//         $counter = $counter + 1;
        
// }
foreach ($_POST as $value) {
  $counter = $counter + 1;
}
#print($counter.'<br>');
$index_counter = $counter/6;
//Get the POST data from insertView
for($i = 1; $i <= $index_counter ; $i = $i+1) {
    $index_name =  'a'.(string)$i;
    $index_stock =  'b'.(string)$i;
    $index_level =  'c'.(string)$i;
    $index_leadtime =  'd'.(string)$i;
    $index_material_name =  'e'.(string)$i;
    $index_material__qty =  'f'.(string)$i;
    //Check if Product has been in the database
    //True -> Update Product info ; False-> Create New Product
    $result = getProductID($_POST[$index_name]);
    if ($result -> num_rows == 0){
        createProduct($_POST[$index_name],$_POST[$index_stock],$_POST[$index_level],$_POST[$index_leadtime],$_POST[$index_material_name],$_POST[$index_material__qty]);
    }else{
        while($rs =mysqli_fetch_assoc($result)){
            $id = $rs['id'];
        }
        updateProduct($_POST[$index_name],$_POST[$index_stock],$_POST[$index_level],$_POST[$index_leadtime],$_POST[$index_material_name],$_POST[$index_material__qty],$id);
    }
}

#$nodeArr = array_unique($nodeArr);
// foreach ($nodeArr as $value){
//   #${''.$value} = $value;
//   ${''.$value} = new TreeNode($value);
// }
// #print_r($nodeArr);

?>