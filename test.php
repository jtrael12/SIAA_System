<!DOCTYPE html>
<html>
    <head>
        <title>testing page</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            td:hover{background-color:#ddd;;cursor: pointer}
			.container {
				font-family: sans-serif;
				font-size:20px;
				box-sizing: border-box;
				margin-top:100px;
				margin-left:260px;
				border: 4px solid white;
				background: #042331;
				border-radius: 15px;
				width: 1050px;
				height:500px;
				display:block;
				overflow-y:auto;
				position:absolute;
			}
			td{
				background:white;
			}
			th{
				color:white;
				position:sticky;
				top:0;
			}
			#table{
				border-collapse: collapse;
				color:black;
				font-size:0.6em;
				border-radius:5px 5px 0 0;
				box-shadow: 0 0 20px rgb(0,0,0,0.15);
				margin-left:-10px;
				margin-top:20px;
			}

			#table thead tr th{
				background-color:#0a5678;
				color: white;
				text-align:center;
				font-weight: bold;
			}
			#table th,td{
				padding:12px 15px;
			}
			#table tbody tr{
				border-bottom: .5px solid #dddddd;
			}
			#table tbody tr:nth-of-type(odd){
				background-color:#f9fdfe;
			}
			#table tbody tr:nth-of-type(even){
				background-color:#e5e5e5;
			}
			#table tbody tr:last-of-type{
				border-bottom: 10px solid #0a5678;
			}

        </style>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body onload="change('table')">
	<?php date_default_timezone_set('Asia/Manila'); ?>
       <!-- <div class="container">
			<table id="table" border="1">
			<thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
            </tr>
            </thead>
			<tbody>
            <tr>
                <td>FN1</td>
                <td>LN1</td>
                <td>10</td>
            </tr>
            
            <tr>
                <td>FN2</td>
                <td>LN2</td>
                <td>20</td>
            </tr>
            
            <tr>
                <td>FN3</td>
                <td>LN3</td>
                <td>30</td>
            </tr>
            
            <tr>
                <td>FN4</td>
                <td>LN4</td>
                <td>40</td>
            </tr>
            
            <tr>
                <td>FN5</td>
                <td>LN5</td>
                <td>50</td>
            </tr>
			</tbody>
        </table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br>1
        </div>
        <script>
            var table = document.getElementById("table"),rIndex,cIndex;
            
			function change(id){
				if(document.getElementsByTagName){ 
					var table = document.getElementById(id);
					var row = table.getElementsByTagName("tr");
					//row[0].style.backgroundColor="blue";
					var td = row.childNodes;
				}
			}
			
            // table rows
            for(var i = 1; i < table.rows.length; i++)
            {
                // row cells
                for(var j = 0; j < table.rows[i].cells.length; j++)
                {
                    table.rows[i].cells[j].onclick = function()
                    {
                        rIndex = this.parentElement.rowIndex;
                        cIndex = this.cellIndex+1;
                        console.log("Row : "+rIndex+" , Cell : "+cIndex);
						
                    };
                }
            }
            
        </script> -->
		
		<div>
			<form method=POST>
				<input type="date" name="picker" value="<?php echo date('Y-m-d'); ?>"></input>
				<input type="submit" name="submit"></input>
			</form>
		</div>
		<div>
		<?php
			include "includes/autoloader.inc.php";
			$prodObj = new ProductContr();
			$saleObj = new SalesContr();
			
			if(isset($_POST['submit'])){
				$d = $_POST['picker'];
				$date1 = date_create($_POST['picker']);
				$fdate = date_format($date1,'Y-m-d H:i:sa');
				$date = $d . " " . date("H:i:sa");
				echo $date;
				echo "<br>$d";
				echo "<br>$fdate";
				$datesu = date("Y-m-d H:i:sa");
				echo "<br>$datesu";
				$returnDate = $_POST['picker'];
				echo "<br>$returnDate";
			}

			$name = "Ribs";
			$product = $prodObj->prodByName($name);
			foreach($product as $row){
				$prod_id = $row['prod_id'];
				$origPrice = $row['prod_originalPrice'];
				$sellingPrice= $row['prod_sellingPrice'];
				$qty = $row['prod_quantity'];
			}
			$check = $saleObj->checkDuplicate($prod_id,$d);
			echo "<br>Prod ID: ".$prod_id;
			echo "<br>";
			echo print_r($check);
			if($check->num_rows > 0){
				echo "<br>Already exists.";
			}
			
		?>
		</div>
    </body>
</html>
