<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta charset="UTF-8"/>
        <title>MRP</title>
        <style type="text/css">
        #main {
            width: 700px;
            margin: 70px auto;
            background-color:#37322f00;
            border: 10px #37322f00 solid ;
        }
        table {
            width: 300px;
            height: 300px;
        }
        #background{
            background-color:#37322f00;
        }
        th ,td {
            background-color:#37322f00;
        }
        div {
            width: 600px;
            height: 300px;
        }
        </style>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <table id="main">
            <form id="team" method="post" accept-charset="utf-8">
                <!-- <div class="logo">
                    <img src="../newBG/image/dbg.gif" width="200" height="200"/>
                </div>
                <div class="logo1">
                    <img src="../newBG/image/logo.png" width="400" height="100"/>
                </div>
                <div class="logo2">
                    <img src="../newBG/image/logo2.png" width="140" height="50"/>
                </div> -->
                <div class="bt" style="text-align:center;">
                    <!-- <input name="button" type="button" onClick="addField()" value="新增欄位">  -->
                    <input type="button" value="庫存列表" onclick="location.href='stockView.php'"> 
                    <input type="button" value="規劃列表" onclick="location.href='orderView.php'"> 
                    <input type="button" value="設定需求與規劃" onclick="location.href='setDemand.php'"> 
					<input type="button" value="輸入零件" onclick="location.href='insertView.php'"> 
                </div>
            </form>
        </table>
    </body>
</html>