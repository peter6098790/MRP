<?php 
error_reporting(E_ALL || ~E_NOTICE);

require('dbconfig.php');
require('setDemand.php');
require('model.php');
$startTime = microtime(TRUE);
$counter = -1;
foreach ($_POST as $value) {
    $counter = $counter + 1;
}
#print($counter.'<br>');

$index_counter = $counter/2;
$target = $_POST['target'];
echo '生產物品:'.$target.'<br/><br/>';
for($i = 1; $i <= $index_counter ; $i = $i+1) {
    $index_week =  'a'.(string)$i;
    $index_demand =  'b'.(string)$i;
    echo '需求: '.$_POST[$index_demand].'<br/>';
    calculateOneOrder($target,$_POST[$index_demand],$_POST[$index_week]);
}
$endTime = microtime(TRUE);
echo $endTime - $startTime.'秒';

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
function addlevel($product,$tmplevel){
    if ($product -> materialList != null){ #isset($product -> materialList)
        if ($product -> level < $tmplevel){
            $product -> level = $tmplevel;
        }
        #echo "found next ,".$product -> name."'s level : " .(string)($product -> level).'<br/>';
        $tmplevel = $tmplevel + 1;
        foreach ( $product -> materialList as $data){
            #echo $data -> name.'<br/>';
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
    #echo $product -> name.' '.$demand;
    if (isset($product -> materialList)){ #$product -> materialList != null
        #echo $product ->name."有";
        if ($demand > $product -> stock){ #需求扣掉庫存得到真正需求量
            $truedemand = $demand - $product-> stock;
            updateProductStock($product -> name,0);
            $product -> stock = 0;
            $product -> demand = $product -> demand + $truedemand;
            foreach ($product -> materialList as $materialdata){
                $index = array_search($materialdata,$product -> materialList);
                #echo '子零件: '.$materialdata -> name.'<br/>';
                #echo '生產所需個數: '.$product->materialnumber[$index].'<br/>';
                array_push($tmpleadtime,countDemandandLeadtime($materialdata,$truedemand,(int)$product->materialnumber[$index]));
            }
            
            $leadtime = $leadtime + max($tmpleadtime) + $product -> leadtime;
            #echo "<br/> total leadtime".$leadtime;
            $product -> maketime = max($tmpleadtime);
        }else{
            $product -> stock = $product -> stock - $demand;
            updateProductStock($product -> name,$product -> stock);
            $product -> demand = 0;
            $product -> maketime = 0;
        }
    //零件
    }else{
        #echo $product ->name."沒有";
        if ($demand > $product -> stock){ #如果需求大於庫存
            $truedemand = $demand - $product -> stock; #需求先扣掉庫存，得到真正需要製作的需求量
            updateProductStock($product -> name,0);
            $product -> $demand = $product -> $demand + $truedemand;
            $leadtime = $leadtime + $product -> leadtime; #$product ->leadtime該產品的製作時間
            $product -> maketime = 0;
        }else{
            $product -> $stock = $product -> stock - $demand;
            updateProductStock($product -> name,$product -> stock);
            $product -> demand = 0;
            $product -> maketime = 0;
        }
    }
    return $leadtime;
}
    //檢查能不能延後訂貨
function smartstorge($product,$totaltime,$level){
        if ($product -> materialList != null){ #isset($product -> materialList)
            foreach($product -> materialList as $next){
                if($product -> level == $level+1){
                    if($product -> demand != 0){
                        $product -> maketime = $totaltime - $product -> leadtime;
                    }
                }
                smartstorge($next,$product -> maketime,$product -> level);
            }
        }else{
            if($product -> level == $level+1){
                if($product -> demand != 0){
                    $product -> maketime = $totaltime - $product -> leadtime;
                }
            }
        }
}
function calculateOneOrder($target,$order_demand,$deadline){
    $tmpArr = [];
    $result = readAllData();
    $counter = -1;
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
        //確定有子零件才做字串分割,不然會存看不到的神奇數值進去
        if ($rs['material_name'] != null){
            ${''.$name} -> materialStringArr = explode(",",$rs['material_name']);
            ${''.$name} -> materialnumber = explode(",",$rs['material_qty']);
        }
        #echo $rs['material_name'].'<br/>';
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
    
    //字串轉物件
    $targetObject = ${''.$target};
    addlevel($targetObject,0);
    $totaltime = countDemandandLeadtime($targetObject,1,$order_demand);# 第三個參數 需求總數
    echo "Total leadtime : ".(string)($totaltime).'<br/>';
    #echo "<br/>";
    //以物件level屬性區分出bom表成員(有計算到level);
    $bom_list = [];
    $material_demand = [];
    foreach($tmpArr as $data2){
        #echo $data.' '.gettype($data).'<br/>';
        $index = ${''.$data2};
        if ($index -> level != -1){
            array_push($bom_list,$index -> name);
            array_push($material_demand,$index -> demand);
        }
    }

    //訂貨優化
    #echo 'smartstorge:<br/>';
    smartstorge($targetObject,0,0);
    $day=time()+(24*60*60*$deadline); //24小時x60分x60秒x7天    
    #echo '今天日期是: '.date('Y-m-d').'<br>';
    echo '交貨日期是: '.date('Y-m-d',$day).'<br>';
    if($deadline < $totaltime){
        echo '無法生產,總生產時間需要'.$totaltime.'天<br/>';
    }else{
        foreach($bom_list as $show){
            $index = ${''.$show};
            $day=time()+(24*60*60*($deadline-$totaltime+${''.$show} -> maketime));
            #echo ${''.$show} -> name.'level:'.${''.$show} -> level.", demand:".${''.$show} -> demand." maketime: ".date('Y-m-d',$day)."<br/>";#$totaltime - 
            if (${''.$show} -> materialList != null){
                echo '在'.date('Y-m-d',$day).' 生產level:'.$index -> level."的元件 ".$index -> name.' '.$index -> demand."個<br/>";
                createOrder(date('Y-m-d',$day),$index -> level,$index -> name,$index -> demand,'make');
            }else{
                echo '在'.date('Y-m-d',$day).' 訂購level:'.$index -> level."的元件 ".$index -> name.' '.$index -> demand."個<br/>";
                createOrder(date('Y-m-d',$day),$index -> level,$index -> name,$index -> demand,'order');
            }
        }
    }
    echo '<br/>';
}

#(string)(${''.$show} -> leadtime)
    
    
    
    
    

    
    


#echo isset($E->materialList);
#echo empty($X->materialList);
#$nodeArr = array_unique($nodeArr);
// foreach ($nodeArr as $value){
//   #${''.$value} = $value;
//   ${''.$value} = new TreeNode($value);
// }
// #print_r($nodeArr);

?>