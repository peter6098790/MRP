<html>
<head>
<title>庫存列表</title>
</head>
<body>
        <table id="main" align="center">
            <!-- <form id="team" method="post" action="teamUpdate.php" accept-charset="utf-8"> -->
            <tr>
                <td colspan="4"> ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                </td>
            </tr>
            <td colspan="4" id="background">
                <!-- <img src="newBG/image/rank.png" width="100"/></br> -->
            <font size="6">庫存列表</font></td>
            <tr>
                <td colspan="4"> ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                </td>
            </tr>
            <tr>
                <td width="120px">零件名稱</td>
                <td width="120px">目前庫存</td>
                <td width="120px">子零件</td>
                <td width="120px">子零件需求數量</td>
            </tr>
            <?php 
                require("model.php");
                showAllProduct();
            ?>
            <tr>
                <td colspan="4"> ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <a id="button" href="index.php">返回主畫面</a>
                </td>
            <tr>
            <tr>
                <td colspan="4"> ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                </td>
            </tr>
            </form>
        </table>
    </body>

</html>
<?php
// require('dbconfig.php');
// require('model.php');
// $results = readAllData();

// $resultsArr=array();     //用來存哪些選項的陣列
// $resultsCount=0;
// while($rows=mysql_fetch_array($results))
// {
// 	#$resultsArr[$resultsCount]=$rows[$pname];
// 	$resultsCount++;
//     echo $resultsArr;
// } -->
// for($i=0;$i<count($resultsArr);$i++)
// {
// 	echo "<script type=\"text/javascript\">";
// 	echo "document.getElementById(\"shopList\").options[$i]=new Option(\"$resultsArr[$i]\",\"$resultsArr[$i]\");";
// 	echo "</script>";
// }
// ?>