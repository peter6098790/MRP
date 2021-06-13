<?php 
error_reporting(E_ALL || ~E_NOTICE);
require('dbconfig.php');
require('setDemand.php');
require('model.php');

$counter = -1;
// foreach ($_POST as $key => $value) {
//         $$key=$value; 
//         $counter = $counter + 1;
        
// }
foreach ($_POST as $value) {
  $counter = $counter + 1;
}
#var_dump($_POST);
$target = $_POST['target'];
echo '目標:'.$target;
echo '<br/>';
#unset($_POST['target']);
#print($counter.'<br>');
$index_counter = $counter/2;
//Get the POST data from insertView
for($i = 1; $i <= $index_counter ; $i = $i+1) {
    $index_week =  'a'.(string)$i;
    $index_demand =  'b'.(string)$i;
    echo '周次: '.$_POST[$index_week];
    echo '需求: '.$_POST[$index_demand];
    echo '<br/>';
    //Check if Product has been in the database
    //True -> Update Product info ; False-> Create New Product
    //計算需求
}

class product
{
    public $level=-1;
    //sub product class array;
    public $materialList = [];
    public $name = '';
    public $number =[];
    public $materialStringArr = [];
}

    $tmpArr = [];
    $result = readAllData('');
    $counter = 0;
    while($rs =mysqli_fetch_assoc($result)){
        echo '<br/>';
        $name=$rs['pname'];
        array_Push($tmpArr,$name);
        if (!isset(${''.$name})){
            ${''.$name} = new product();
        }
        #${''.$value} -> name = $rs['pname'];
        #$tmpArr = array_unique($tmpArr);
        #echo $rs['pname'];
        #echo '<br/>';
        ${''.$name} -> name = $rs['pname'];
        ${''.$name} -> materialStringArr = explode(",",$rs['material_name']);
        #echo ${''.$value} -> name.' ';
        #echo ${''.$name} -> materialStringArr[0];
        #echo ${''.$name} -> materialStringArr[1];
        #echo "<br/>";
            #echo $value ->level;
        // foreach($tmpArr as $value){
        //     echo $value.' '.$rs['pname'];
        //     echo '<br/>';
        //     ${''.$value} -> name = $rs['pname'];
        //     ${''.$value} -> materialStringArr = explode(",",$rs['material_name']);
        //     #echo $value ->level;
        // }
    }
    foreach($tmpArr as $value){
        $Arr =[];
        #$tes = ${''.$value} -> materialStringArr[0];
        echo '<br/>Class: '.$value.'<br/>';
        $materialStringArr = ${''.$value} -> materialStringArr ;
        foreach($materialStringArr as $value2){
            echo '子零件:'.$value2."<br/>";
            $tmpClass = ${''.$value2};
            array_push($Arr,$tmpClass);
        }
        //檢查
        foreach ($Arr as $arr) {
            echo '子零件屬性: ' . $arr->level . ' ' . $arr->name . "\n";
        }
        ${''.$value} -> materialList = $Arr;
        #echo '<br/>';
    }
    #echo '<br/>';
    #var_dump($X);
    #echo '<br/>';
    #var_dump($X);
    #echo '<br/>';
    #var_dump($A);
    #echo '<br/>';
    // foreach($tmpArr as $value){
    //     echo ${''.$value} -> level;
    //     #echo $value ->level;
    // }
    function addlevel($product,$tmplevel){
        if (isset($product -> materialList)){
            if ($product -> level < $tmplevel){
                $product -> level = $tmplevel;
            }
            echo "found next ,".$product -> name."'level : " .(string)($product -> level).'<br/>';
            $tmplevel = $tmplevel + 1;
            foreach ( $product -> materialList as $data){
                echo $data -> name;
                addlevel($data,$tmplevel);
            }
        }else{
            if ($product -> level < $tmplevel){
                $product -> level = $tmplevel;
            }
            echo "not found next ,".$product -> name."'level : " .(string)($product -> level).'<br/>';
        }
        
    }
    function countDemand($product,$demand){
        if (isset($product -> materialList)){
            if ($demand > $product -> stock){

            }
            foreach($product -> materialList as $data){
                counternumber($data,$product -> stock);
            }
        }else{

        }
    }

    $Alllist =[];
    array_push($Alllist,${''.$target});
    foreach ($Alllist as $data){
        $level = 0;
        echo $data -> name." : <br/>";
        addlevel($data,$level);
    }
// echo "X, level:";
// echo $X -> level;
// echo "<br/>";
// echo "B, level:";
// echo $B -> level;
// echo "<br/>";
// echo "C, level:";
// echo $C -> level;
// echo "<br/>";
// echo "D, level:";
// echo $D -> level;
// echo "<br/>";
// echo "E, level:";
// echo $E -> level;
// echo "<br/>";
// echo "F, level:";
// echo $F -> level;
// echo "<br/>";
echo "testP, level:";
echo $testP -> level;
echo "<br/>";
echo "testA, level:";
echo $testA -> level;
echo "<br/>";
echo "testC, level:";
echo $testC -> level;
echo "<br/>";
echo "testD, level:";
echo $testD -> level;
echo "<br/>";
echo "testN, level:";
echo $testN -> level;
echo "<br/>";
echo "testM, level:";
echo $testM -> level;
echo "<br/>";
echo isset($E->materialList);
echo "<br/>";
echo isset($X->materialList);
#$nodeArr = array_unique($nodeArr);
// foreach ($nodeArr as $value){
//   #${''.$value} = $value;
//   ${''.$value} = new TreeNode($value);
// }
// #print_r($nodeArr);

?>