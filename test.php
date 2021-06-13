<?php
    $Arr = ['X'=>'B,C','B' => 'D,E', 'C' => 'E,F', 'D' => 'E','E'=>'','F'=>'']; # 
    $levelArr=[];
    $level = -1;
    $tempArr = ['X'];
    #factorial($tempArr,$Arr);
    #function factorial($temArr,$Arr){
       # $temArray = $temArr;
        #$Array =$Arr;
    while($tempArr[0]!==''){
        
        if ($tempArr[0]==''){
            echo 'done';
            break;
        }
        foreach ($tempArr as $value){
            echo '<br/>';
            echo '初始狀態';
            echo '<br/>';
            print_r($tempArr);
            $level = $level +1;
            #echo '<br/>';
            echo 'level:'.$level.' '.$value;
            #echo '<br/>';
            $string = $Arr[$value];
            echo $string;
            $stringArr = explode(",",$string);
            foreach ($stringArr as $value2){
                #$level[$value2] = $level;
                echo '<br/>';
                echo $value2;
                array_push($tempArr,$value2);
                echo '<br/>';
                echo 'push後:<br/>';
                print_r($tempArr);
            }

            unset($tempArr[0]);
            $tempArr =array_values($tempArr);
            #print_r(mb_split("\s",$mystring));
            echo '<br/>最終:<br/>';
            print_r($tempArr);
            echo '<br/>=========================';
        }
        #return factorial($tempArr[0],$Array);
    }
        
?>