<!DOCTYPE html>
<html>
    <head>
        <title>Ordering_Reservation</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			body{
	background:url("../css/bg_home.jpg") no-repeat center fixed;
	-webkit-background-size:cover;
	-moz-background-size:cover;
	-o-background-size: cover;
	background-size:cover;
    font-family: 'Roboto', sans-serif;
}


.upperbar{
color:white;
text-align:left;
width:100%;
height:10%;
background:white;
border-bottom:1px solid grey;
border-bottom:1px solid grey;
position:fixed;
top:0;
z-index:1;
}

.upperbar h1{
	font-size:120%;
	margin-left:50px;
	margin-top:20px;
	margin-bottom:40px;
	color: grey;
}	
#home{
font-family: sans-serif;
font-size:1em;
color:white;
text-align:center;
line-height:30px;
background:#0a5678;

position:absolute;
width:7%;
margin-top:-70px;
margin-left:980px;
border: 2px solid black;
border-radius: 15px;
}
#Order{
font-family: sans-serif;
font-size:1em;
color:white;
text-align:center;
line-height:30px;
background:#0a5678;
position:absolute;
width:7%;
margin-top:-70px;
margin-left:1090px;
border: 2px solid black;
border-radius: 15px;
}
#how_to_pay{
font-family: sans-serif;
font-size:1em;
color:white;
text-align:center;
line-height:30px;
background:#0a5678;
position:absolute;
width:9%;
margin-top:-70px;
margin-left:1200px;
border: 2px solid black;
border-radius: 15px;
}

h2{
font-family: sans-serif;
font-size:1.5em;
color:white;
text-align:center;
line-height:40px;
background:#0a5678;
margin-bottom:20px;
position:absolute;
width:30%;
margin-top:80px;
margin-left:480px;
border: 2px solid black;
border-radius: 15px;
}

.prod{
position:absolute;
margin-left:400px;
margin-top:150px;	
text-align:center;
}

.input_fname{
position:absolute;
margin-left:20px;
margin-top:100px;	
margin-bottom:20px;
text-align:center;
display: block;
border: 2px solid #063146;
width: 13%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
margin-top:108px;
margin-left:1120px;
}

.input_lname{
position:absolute;
margin-left:20px;
margin-top:100px;		
margin-bottom:20px;
text-align:center;
display: block;
border: 2px solid #063146;
width: 13%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
margin-top:160px;
margin-left:1120px;
}

.input_contact{
position:absolute;
margin-left:20px;
margin-top:100px;		
margin-bottom:20px;
text-align:center;
display: block;
border: 2px solid #063146;
width: 13%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
margin-top:212px;
margin-left:1120px;
}

.input_pickup{
position:absolute;
margin-left:20px;
margin-top:100px;		
margin-bottom:20px;
text-align:center;
display: block;
border: 2px solid #063146;
width: 13%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
margin-top:265px;
margin-left:1120px;
}

.input_submit{
position:absolute;
margin-left:20px;
margin-top:140px;		
margin-bottom:20px;
text-align:center;
display: block;
border: 2px solid #063146;
width: 13%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
margin-top:320px;
margin-left:1120px;
}



.background_input{
	font-family: monospace;
	box-sizing: border-box;
	color: black;
	margin-top:90px;
	margin-left:1080px;
	position: absolute;
	border: 4px solid #0a5678;
	padding: 60px;
	background:rgb(0,0,0,);
    background:rgba(0,0,0,0.5);
	border-radius: 15px;
	padding-top: 200px;
    padding-right:50px;
    padding-bottom:100px;
    padding-left:200px;
	
}
.table{
	border-collapse: collapse;
	width:50%;
	margin-top: 150px;
    margin-left:300px;
    font-size: large;
	border-radius:5px 5px 0 0;
	box-shadow: 0 0 20px rgb(0,0,0,0.15);
	position:absolute;
    color:#063146;
	font-family: monospace;
	text-align:center;
}
th{
	position:sticky;
	top:58px;
	text-align:center;
}
.table thead tr th{
	background-color:#0a5678;
	color: white;
	text-align:left;
	font-weight: bold;
	border:none;
	
}
td {
  font-size: large;
  font-family: sans-serif;
  height: 50px;
  vertical-align: center;
  background:transparent;
  border: 4px solid transparent;
  
}
table th,td{
	padding:15px 18px;
}
.table tbody tr{
	border-bottom: .5px solid #dddddd;
}
.table tbody tr:nth-of-type(odd){
	background-color:#f9fdfe;
}
.table tbody tr:nth-of-type(even){
	background-color: #ffffdf;
}
.table tbody tr:last-of-type{
	border-bottom: 10px solid #0a5678;
}




	</style>
	</head>
	<body>
	 <div class="upperbar">
  <h1><?php date_default_timezone_set('Asia/Manila'); echo " ". date('F j, Y g:i:a  ');?></h1>
  <a href=homepage.php id=home> Home </a>
  <a href=ordering.php.php id=Order> Order </a>
  <a href=howtopay.php id=how_to_pay> How to pay </a>
  </div>
  
  	 <h2>Ordering And Reservation</h2>
	  <table class="table" table border = 10 bgcolor=white>
	<thead>
		<tr>
		<th>Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		</tr>
	</thead>
	<tbody>
		<div>
		<div class=prod>
			<form method=POST action="ordering.php">
				<?php
					date_default_timezone_set('Asia/Manila');
					include "../db_conn.php";
					if($conn->connect_error)
						die("Connection Error" .$conn->connect_error);
					
					$sql = "SELECT prod_id,prod_name,prod_sellingPrice,prod_description,prod_uom FROM product where prod_status=1 order by prod_category";
					$result = $conn->query($sql);
					$prices = array();
					$prod_id = array();
					$ctr=0;
					  
					while($row = $result->fetch_assoc()){
						$prices[] = $row['prod_sellingPrice'];
						$prod_id[] = $row['prod_id'];
						$prod_description = $row['prod_description'];
						$product = $row['prod_name'];
						$prod_uom = $row['prod_uom'];
						
						echo"<tr>";	
						if($prod_uom==1){
						echo"<td><input type='checkbox' name='products[]' value='$product'>".$product."(".$prod_description.")</input>";	
						echo"<td>".$row['prod_sellingPrice'];
						echo "<td><input type='number' name='qty[]' min='.5' max='10' step='any'></input>";						
						echo "<br>";
						}
						else{
							echo"<td><input type='checkbox' name='products[]' value='$product'>".$product."</input>";
							echo"<td>".$row['prod_sellingPrice'];
							echo "<td><input type='number' name='qty[]' min='.5' max='10' step='any'></input>";						
							echo "<br>";
						}
						$ctr++;
					}
					echo"</table>";
					//date pick up min
					$now = date("Y-m-d H:i");
					$current=date_create($now);
					$add = date_add($current,date_interval_create_from_date_string("2 days"));
					$min = date_format($add,"Y-m-d");
					
				?>
				</div>
				 <div class=background_input>
		   </div>
		<input name=first placeholder="First Name" class="input_fname"required></input>
		<input name=last placeholder="Last Name" class="input_lname" required></input>
		<input name=contact placeholder="contact number" class="input_contact" maxlength="11" required></input>
		<input type="datetime-local" id="pickup" name="pickup"  class="input_pickup" min="<?php echo $min; ?>T09:00" required>
		<input type="submit" name="submit"  class="input_submit"></input>
			</form>
		</div>
    </body>
</html>
<?php

	if(isset($_POST['submit'])){
		if(isset($_POST['products'])){
			$products = $_POST['products'];
			$quantity = $_POST['qty'];
			$fname = $_POST['first'];
			$lname = $_POST['last'];
			$contact = $_POST['contact'];
			$pickup = $_POST['pickup'];
			
			//storing of data muna
			$prods = array();
			$qty = array();
			$prc = array();
			$p_id = array();
			foreach($products as $value){
				$prods[] = $value;
			}
			for($i=0; $i < count($quantity); $i++){
				if($quantity[$i]>0){
					echo $quantity[$i];
					$qty[] = $quantity[$i];
					$prc[] = $prices[$i];
					$p_id[] = $prod_id[$i];
				}
				
			}
			
			
			// I. CUSTOMER INFO
			$sql = "INSERT INTO customer VALUES(null,'$lname','$fname','$contact')";
			if($conn->query($sql)==TRUE){
				// II. ORDER
				$sql = "SELECT c_id FROM customer WHERE c_last='$lname' AND c_first='$fname' AND c_contact='$contact'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$c_id = $row["c_id"];
				//COMPUTE TOTAL for ORDERS
				$total = 0;
				for($i=0; $i < count($prc); $i++){
					$total += ($prc[$i] * $qty[$i]);
				}
				//STATUS = 0(PENDING)
				$date = date("Y-m-d H:i:s");
				$sql = "INSERT INTO orders VALUES(null,$c_id,'$date','$pickup',1,$total,$total)";
				if($conn->query($sql)==TRUE){
					// III. ORDER DETAILS
					//get the order for order details
					$sql = "SELECT o_id FROM orders WHERE o_customer = $c_id AND o_dateMade='$date'";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$o_id = $row["o_id"];
					$sum=0;
					for($i=0; $i < count($prods); $i++){
						$sum = floatval($prc[$i]) * floatval($qty[$i]);
						
						$sql = "INSERT INTO order_details VALUES($o_id,$p_id[$i],$qty[$i],$sum)";
						if($conn->query($sql)==TRUE){
							echo "";
						}
					}
					?><script>alert("Order successfully made!")</script><?php
				}
			}
		}
		else
			echo "Select a product!";
	}

?>
