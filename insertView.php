<html> 
	    <head>
	        <title>新增零件</title> 
	        <Meta http-equiv='Content-Type' content='text/html; charset=big5'> 
	        <style> 
	            body {font: 13px Arial} 
	            #table1 td {text-align: center; font: 13px Arial; color: #FFFF00; height: 20px;} 
	            #table1 select {font-size: 13px; width: 40px;} 
				#table1{margin-left:auto; margin-right:auto;}
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
                    // var td3 = tr.insertCell(-1);
					var td4 = tr.insertCell(-1);
                    var td5 = tr.insertCell(-1);
					var td6 = tr.insertCell(-1);
	                //將名稱欄位的class設為aclass , 
	                //給一唯一id 
	                td.innerHTML = "<input type=text id=a" + idcount + " name=a" + idcount + ">";    
                    td2.innerHTML = "<input type=text id=b" + idcount + " name=b" + idcount + ">";
                    // td3.innerHTML = "<input type=text id=c" + idcount + " name=c" + idcount + ">";  
					td4.innerHTML = "<input type=text id=d" + idcount + " name=d" + idcount + ">"; 
                    td5.innerHTML = "<input type=text id=e" + idcount + " name=e" + idcount + ">";
                    td6.innerHTML = "<input type=text id=f" + idcount + " name=f" + idcount + ">";      
	                //若有其他欄位，方式相同 
	                document.getElementById("a"+idcount).focus(); 
                    document.getElementById("b"+idcount).focus();
                    // document.getElementById("c"+idcount).focus();
					document.getElementById("d"+idcount).focus();
                    document.getElementById("e"+idcount).focus();
                    document.getElementById("f"+idcount).focus();
	                idcount = idcount + 1; 
	                return false 
	            }  
	             
	        </script> 
	         
	    </head> 
	    <body> 
	     
	        <form action = './insert.php' method = 'post'> 
	            <table width="267" border="1" bordercolor="#CCCCCC" id="table1"> 
	                <tr> 
                        <td bgcolor="#7F9DB9" width="201">物料名稱</td> 
                        <td bgcolor="#7F9DB9" width="201">目前庫存</td> 
						<!-- <td bgcolor="#7F9DB9" width="201">階級</td>  -->
                        <td bgcolor="#7F9DB9" width="201">前置時間</td> 
                        <td bgcolor="#7F9DB9" width="201">子材料</td> 
                        <td bgcolor="#7F9DB9" width="201">子材料數量</td> 
	                </tr> 
	                <tr id="tr1">      
                        <td width="201"> 
                            <input type="text" id="a1" name="a1" >       
	                    <td width="201">                     
	                        <input type="text" id="b1" name="b1" >
                        <!-- <td width="201">                     
	                        <input type="text" id="c1" name="c1"> -->
						<td width="201">                     
	                        <input type="text" id="d1" name="d1" >
                        <td width="201">                     
	                        <input type="text" id="e1" name="e1" placeholder='複數請以,分開 可留空'>
                        <td width="201">                     
	                        <input type="text" id="f1" name="f1" placeholder='複數請以,分開 可留空'>
	                  </td> 
	                </tr> 
                
	            </table>  
                <p Align="Center"> 
	                <input name="button" type="button" onClick="addField()" value="新增欄位"> 
                    <input name="button" type="submit"  value="確認"> 
					<input type="button" value="回主選單" onclick="location.href='index.php'"> 
	            </p>  
	        </form>  
	 
	    </body> 
	</html> 