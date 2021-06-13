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
    public $name = '';
    public $stock = 0 ;
    public $leadtime = 0 ;
    //sub product class array
    public $materialStringArr = [];
    public $materialList = [];
    //sub product needed array
    public $materialnumber =[];
    public $demand = 0 ;
    public $maketime = 0;
}

    $tmpArr = [];
    $result = readAllData('');
    $counter = 0;
    //read data from DB
    while($rs =mysqli_fetch_assoc($result)){
        #echo '<br/>';
        $name=$rs['pname'];
        array_Push($tmpArr,$name);
        //每個零件都生成為物件
        if (!isset(${''.$name})){
            ${''.$name} = new product();
        }
        //設定屬性
        ${''.$name} -> name = $rs['pname'];
        ${''.$name} -> stock = $rs['stock'];
        ${''.$name} -> leadtime = $rs['leadtime'];
        ${''.$name} -> materialStringArr = explode(",",$rs['material_name']);
        ${''.$name} -> materialnumber = explode(",",$rs['material_qty']);
    }

    foreach($tmpArr as $value){
        $Arr =[];
        #echo '<br/>Class: '.$value.'<br/>';
        $materialStringArr = ${''.$value} -> materialStringArr ;
        foreach($materialStringArr as $value2){
            #echo '子零件:'.$value2."<br/>";
            $tmpClass = ${''.$value2};
            array_push($Arr,$tmpClass);
        }
        //檢查
        // foreach ($Arr as $arr) {
        //     echo '子零件屬性: ' . $arr->level . ' ' . $arr->name . "\n";
        // }
        ${''.$value} -> materialList = $Arr;
    }
    function addlevel($product,$tmplevel){
        if (isset($product -> materialList)){
            if ($product -> level < $tmplevel){
                $product -> level = $tmplevel;
            }
            #echo "found next ,".$product -> name."'level : " .(string)($product -> level).'<br/>';
            $tmplevel = $tmplevel + 1;
            foreach ( $product -> materialList as $data){
                #echo $data -> name;
                addlevel($data,$tmplevel);
            }
        }else{
            if ($product -> level < $tmplevel){
                $product -> level = $tmplevel;
            }
            #echo "not found next ,".$product -> name."'level : " .(string)($product -> level).'<br/><br/>';
        }
    }
    function countDemandandLeadtime($product,$demand,$data){ #product: 產品class, demand: 上階產品需求量 , data該階產品總需求
        $demand = $demand * $data;
        $leadtime = 0;
        $tmpleadtime = [];
        //半成品or成品
        if (isset($product -> materialList)){
            #echo $product ->name."有";
            if ($demand > $product -> stock){ #需求扣掉庫存得到真正需求量
                $truedemand = $demand - $product-> stock;
                $product -> demand = $product -> demand + $truedemand;
                foreach ($product -> materialList as $materialdata){
                    $index = array_search($materialdata,$product -> materialList);
                    echo '子零件: '.$materialdata -> name.'<br/>';
                    echo '生產所需個數: '.$product->materialnumber[$index].'<br/>';
                    array_push($tmpleadtime,countDemandandLeadtime($materialdata,$truedemand,(int)$product->materialnumber[$index]));
                }
                $leadtime = $leadtime + max($tmpleadtime) + $product -> leadtime;
                $product -> maketime = max($tmpleadtime);
            }else{
                $product -> stock = $product -> stock - $demand;
                $product -> demand = 0;
            }
        //零件
        }else{
            #echo $product ->name."沒有";
            if ($demand > $product -> stock){ #如果需求大於庫存
                $truedemand = $demand - $product -> stock; #需求先扣掉庫存，得到真正需要製作的需求量
                $product -> $demand = $product -> $demand + $truedemand;
                $leadtime = $leadtime + $product -> leadtime; #$product ->leadtime該產品的製作時間
            }else{
                $product -> $stock = $product -> stock - $demand;
                $product -> demand = 0;
            }
        }
        return $leadtime;
    }

    $Alllist =[];
    array_push($Alllist,${''.$target});
    // foreach ($Alllist as $data){
    //     $level = 0;
    //     echo $data -> name." : <br/>";
    //     addlevel($data,$level);
    // }
    
    foreach ($Alllist as $data){
        echo $data->name."'s demand : ".(string)($data->demand).'<br/>';
        $totaltime = countDemandandLeadtime($data,1,1);
        echo "Total leadtime : ".(string)($totaltime).'<br/>';
        #countdemand($data,1,1);
        echo "<br/>";
        echo "X, demand:".$X -> demand." maketime: ".(string)($totaltime - $X -> maketime)."<br/>";
        echo "B, demand:".$B -> demand." maketime: ".(string)($totaltime - $B -> maketime)."<br/>";
        echo "C, demand:".$C -> demand." maketime: ".(string)($totaltime - $C -> maketime)."<br/>";
        echo "D, demand:".$D -> demand." maketime: ".(string)($totaltime - $D -> maketime)."<br/>";
        echo "E, demand:".$E -> demand." maketime: ".(string)($totaltime - $E -> maketime)."<br/>";
        echo "F, demand:".$F -> demand." maketime: ".(string)($totaltime - $F -> maketime)."<br/>";
    }

#echo gettype($X -> leadtime);




// echo "B, demand:";
// echo $B -> demand;
// echo "<br/>";
// echo "B, maketime:";
// echo $B -> maketime;

// echo "<br/>";
// echo "C, demand:";
// echo $C -> demand;
// echo "<br/>";
// echo "C, maketime:";
// echo $C -> maketime;

// echo "<br/>";
// echo "D, demand:";
// echo $D -> demand;
// echo "<br/>";
// echo "D, maketime:";
// echo $D -> maketime;

// echo "<br/>";
// echo "E, demand:";
// echo $E -> demand;
// echo "<br/>";
// echo "E, maketime:";
// echo $E -> maketime;

// echo "<br/>";
// echo "F, demand:";
// echo $F -> demand;
// echo "<br/>";
// echo "F, maketime:";
// echo $F -> maketime;
// echo "<br/>";
// foreach ($X->materialnumber as $print){
//     echo $print;
// }
#echo isset($E->materialList);
#echo empty($X->materialList);
#$nodeArr = array_unique($nodeArr);
// foreach ($nodeArr as $value){
//   #${''.$value} = $value;
//   ${''.$value} = new TreeNode($value);
// }
// #print_r($nodeArr);

?>