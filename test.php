<html>
<head>
<title>下拉式選單測試</title>
</head>
<body>
    <select id="shopList">
    	<option></option>
    </select>  
</body>
<?php
require('dbconfig.php');
require('model.php');
$results = readAllData();

$resultsArr=array();     //用來存哪些選項的陣列
$resultsCount=0;
while($rows=mysql_fetch_array($results))
{
	#$resultsArr[$resultsCount]=$rows[$pname];
	$resultsCount++;
    echo $resultsArr;
}
// for($i=0;$i<count($resultsArr);$i++)
// {
// 	echo "<script type=\"text/javascript\">";
// 	echo "document.getElementById(\"shopList\").options[$i]=new Option(\"$resultsArr[$i]\",\"$resultsArr[$i]\");";
// 	echo "</script>";
// }
?>
</html>