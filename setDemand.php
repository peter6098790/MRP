<html> 
	    <head> 
	        <title>設定需求</title> 
	        <Meta http-equiv='Content-Type' content='text/html; charset=big5'> 
	        <style> 
	            body {font: 13px Arial} 
	            #table1 td {text-align: center; font: 13px Arial; color: #FFFF00; height: 20px} 
	            #table1 select {font-size: 13px; width: 40px} 
	            .red {color: red; font: bold 13px Arial} 
	        </style> 
	         
	        <script language="javascript">  
	            //唯一id取值 
	            var idcount = 2;  
	 
	            function addField()  
	            {  
	                var table = document.getElementById("table1"); 
	                             
	                var tr = table.insertRow(-1); 
	                //給每個tr一個唯一id 
	                tr.id = "tr" + idcount;           
	                //新增輸入名稱欄位 
	                var td = tr.insertCell(-1); 
                    var td2 = tr.insertCell(-1); 
	                //將名稱欄位的class設為aclass , 
	                //給一唯一id 
	                td.innerHTML = "<input type=text id=a" + idcount + " name=a" + idcount + ">";    
                    td2.innerHTML = "<input type=text id=b" + idcount + " name=b" + idcount + ">";
	                //若有其他欄位，方式相同 
	                document.getElementById("a"+idcount).focus(); 
                    document.getElementById("b"+idcount).focus();
	                idcount = idcount + 1; 
	                return false 
	            }  
	             
	        </script> 
	         
	    </head> 
	    <body>
	        <form action = './plan.php' method = 'post'>
				<input name="target" type="text"  id='target' align="center" placeholder='生產產品'> 
	            <table width="267" border="1" bordercolor="#CCCCCC" id="table1"> 
	                <tr> 
                        <td bgcolor="#7F9DB9" width="201">周次</td> 
                        <td bgcolor="#7F9DB9" width="201">需求</td> 
	                </tr> 
	                <tr id="tr1">      
                        <td width="201"> 
                            <input type="text" id="a1" name="a1" placeholder='幾周後交貨'>       
	                    <td width="201">                     
	                        <input type="text" id="b1" name="b1" placeholder='需求數量'>
	                  </td> 
	                </tr> 
	            </table>  
                <p> 
                    <input name="button" type="button" onClick="addField()" value="新增欄位" align="center"> 
                    <input name="button" type="submit"  value="確認" align="center"> 
                    <input type="button" value="回主選單" onclick="location.href='index.php'"> 
	            </p>  
	        </form>  
	 
	    </body> 
	</html> 