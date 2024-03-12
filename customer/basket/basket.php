<!DOCTYPE html>
<html lang="en">
<head>
	<title>ตะกร้าของฉัน</title>
	<meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../../image_logo/logo.png" />
    <link href="./basketstyles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- <script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel="stylesheet" href="./basketstyles.css">
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'>


</head>
<body style="background-color: #1a1a1a; color: #ffffff; font-family: Noto Sans Thai, sans-serif;">
	<div class="navigation-wrap start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<nav class="navbar navbar-expand-md navbar-light">
					
					<a class="navbar-brand" ><img src="../../image_logo/logotab2.png" alt=""></a>	
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto py-4 py-md-0" style="text-align: center;" >
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../index.php">หน้าหลัก</a>
							</li>
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
								<a class="nav-link" href="../menuorder/menu.php">รายการอาหาร</a>
							</li>
							<?php
							if(!isset($_COOKIE['tableId'])) {
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="#">จองโต๊ะ</a>
									</li>';
							}else{
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../Check_status/index.php">สถานะออเดอร์ของฉัน</a>
							</li>
              			
												<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../review/index.php">รีวิวและรายงานปัญหา</a>
								</li>
								'
								;
							}


							?>
						
							
						
							<?php
							if(isset($_COOKIE['tableId'])) {
								echo '<a class=" pl-4 pl-md-0 ml-0 ml-md-4 customnav">&nbsp;&nbsp;&nbsp;&nbsp;ลูกค้าโต๊ะที่ '.$_COOKIE['tableId'].'</a>
										';
							}
							?>
							</ul>

					</div>
					
				</nav>		
				</div>
			</div>
		</div>
	</div>


	<div style="height: 110px;"></div>

	<div class="container">
			<h1 class="h-menu">
				<a href="../menuorder/menu.php">
					<button type="button" class="btn btn-danger" onclick="location.href = 'menu.php';">
						<i class="fa-solid fa-left-long"></i>
					</button> 
				</a>
				
				รายการสั่งอาหาร
				
			</h1>

			
			<hr color=red size=30>

			
				<div class="row" id="main">
					<div class="col-12 col-lg-8">
		
						<?php
						session_start();
						include('../../connectDatabase/connectToDatabase.php');
						$conn = new database();
						if(isset($_COOKIE['tableId'])){
							$tableID = $_COOKIE['tableId'];
						}
						

						$sql = "SELECT * FROM BasketOrder Right JOIN Menu ON BasketOrder.menuId = Menu.menuID WHERE basketId IS NOT NULL AND tableId = $tableID";
						$result =  mysqli_query($conn->getDatabase(), $sql);
						
						

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$foodid = $row['menuId'];

						echo "
													<div class=\"menu-card\" id=\"$foodid-card\">
														<div class=\"row\">
															<div class=\"img col-5 col-sm-4 col-lg-4\">
																<img  src=\"../../image_menu/".$row["image_menu"] . "\" class=\"img-menu\">".
															"</div>
															<div class=\"col-4 col-sm-5 col-lg-5\">
																<div class=\"head\"></div>
																<h5>" . $row["menu_name"] . "</h5>
																<p>จำนวน</p>
																<h6>ราคารวม</h6>
															</div>
															<div class=\"col-3 col-lg-3\">
															<input type=\"hidden\" id=\"actionField\" name=\"action\">
																<span>
																	<div class=\"xmark\" style=\"text-align: right; color: rgb(132, 132, 132);\">
																	
																		<i  name=\"delete\" id=\"delete\" class=\"fa-solid fa-xmark\" onclick=\"deleteCard('$foodid')\"></i>
																	</div>
																</span>
																<h5 class=\"menu-price\"> " .  $row["menu_price"] . ".00 ฿</h5>
																
																<div class=\"qty mt-5\" style=\"margin-top: 0rem!important; margin-left: 3%;\">
																	<div class='menuC'>
																	<span class=\"minus bg-dark \" name=\"minuss\" id=\"minuss\" onclick=\"minus('$foodid')\">-</span>
																			<input onchange=\"updatedatabase($foodid)\" type=\"number\" class=\"count\" id=\"$foodid\" name=\"qty\" value=\"" .$row['countMenu']. "\">
																	<span class=\"plus bg-dark \" name=\"pluss\" id=\"pluss\" onclick=\"plus('$foodid')\">+</span>
																	</div>
																</div>

																<h6 id=\"each-total\" class=\"each-total\"><br>". $row["menu_price"]*$row['countMenu'] . ".00 ฿</h6>
															</div>
														</div>
													</div>";
							}
						}else{
						  echo '<div class="menu-card">
									<div class="textmenucard">
											<h3><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-x" viewBox="0 0 16 20">
											<path fill-rule="evenodd" d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708"/>
											<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
										  </svg>ยังไม่มีรายการอาหารที่สั่ง</h3>
									</div>
								</div>';

						}
						
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							// ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ foodid และ count หรือไม่
							if (isset($_POST['foodid']) && isset($_POST['count'])) {
								$foodid = $_POST['foodid'];
								$count = $_POST['count'];
								// อัพเดตคอลัมน์ countMenu ในตาราง BasketOrder
								$sqlup = "UPDATE BasketOrder SET countMenu = $count WHERE menuId = $foodid AND tableId = $tableID";
								mysqli_query($conn->getDatabase(), $sqlup);
								// อัพเดตคอลัมน์ menuTotal ในตาราง BasketOrder
								$sqlp = "UPDATE BasketOrder 
								JOIN Menu ON BasketOrder.menuId = Menu.menuId
								SET BasketOrder.menuTotal = ($count * Menu.menu_price) 
								WHERE BasketOrder.menuId = $foodid 
								AND BasketOrder.tableId = $tableID";
							    mysqli_query($conn->getDatabase(), $sqlp);
								// $sqlx = "UPDATE BasketOrder SET menuTotal = Total + menuTotal";
								// mysqli_query($conn->getDatabase(), $sqlx);
								
								
							}
							if(isset($_POST['delete'])){
								$foodid = $_POST['foodid'];
								$deletee = "DELETE FROM BasketOrder WHERE menuId = $foodid AND tableId = $tableID";
								mysqli_query($conn->getDatabase(), $deletee);
							}

							if(isset($_POST['submitOrder'])){
								

								$sqlr = "SELECT SUM(menuTotal) as Total FROM BasketOrder WHERE tableId = $tableID";
								$resultTotal =  mysqli_fetch_assoc(mysqli_query($conn->getDatabase(), $sqlr));
								$total = $resultTotal['Total'];
								
								// สร้างอาร์เรย์เพื่อเก็บรายละเอียดการสั่งซื้อ
								$orderData = array();

								// คิวรีเพื่อเลือกรายละเอียดการสั่งซื้อจากตาราง BasketOrder
								$sqlOrder = "SELECT * FROM BasketOrder WHERE tableId = $tableID";
								$resultOrder = mysqli_query($conn->getDatabase(), $sqlOrder);

								// ตรวจสอบว่ามีแถวที่ถูกส่งกลับจากคิวรีหรือไม่
								if ($resultOrder->num_rows > 0) {
									// วนลูปผ่านทุกแถวของผลลัพธ์
									while($row = $resultOrder->fetch_assoc()) {
										// นำ menuId และ menuCount เข้าไปในอาร์เรย์ $orderData
										$orderData[] = array(
											"menuId" => $row['menuId'],
											"menuCount" => $row['countMenu']
										);
									}
								}

								// สร้างสตริง JSON
								$json_data = array(
									"order" => $orderData // เพิ่มอาร์เรย์ $orderData เข้าไปใน key "order"
								);

						
								$order_menu_json = json_encode($json_data); // แปลง array เป็น JSON
								$num = mysqli_num_rows($conn->executeQuery("OrderTable"))+1;
								$sql = $sql = "INSERT INTO OrderTable(orderMenu, tableid, orderTime, orderStatus, orderTotal) 
								VALUES ('$order_menu_json', $tableID, CONVERT_TZ(NOW(),@@session.time_zone,'+07:00'), 'take', $total)";
								mysqli_query($conn->getDatabase(), $sql);

								$orderid = mysqli_insert_id($conn->getDatabase());

								$insert_sql = "INSERT INTO Bill(tableId, billTotal, orderid, billStatus) VALUES  ($tableID, $total, $orderid, 'no')";
								mysqli_query($conn->getDatabase(), $insert_sql);
								$sqldel = "DELETE FROM BasketOrder WHERE tableId = $tableID";
								mysqli_query($conn->getDatabase(), $sqldel);
								$sqltel = "UPDATE Tables SET table_status = 'full', checkIn = CONVERT_TZ(NOW(),@@session.time_zone,'+07:00') WHERE tableID = $tableID";
								mysqli_query($conn->getDatabase(), $sqltel);
								
							}
									

						};
						?>

					</div>
						<div class="col-12 col-lg-4">
										<div class="container bill-card">
											<h6><br>สรุปยอดการสั่งอาหาร</h6>
											<hr>
												<table border="0" style="text-align: right;" class="col-12">
													<tr class="th">
														<td class="menu">รายการอาหาร</td>
														<td>ราคา(฿)</td>
														<td>จำนวน</td>
														<td>ราคารวม(฿)</td>
													</tr>
							<?php
							$sql = "SELECT * FROM BasketOrder Right JOIN Menu ON BasketOrder.menuId = Menu.menuID WHERE basketId IS NOT NULL  AND tableId = $tableID";
							$result =  mysqli_query($conn->getDatabase(), $sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
								echo " <tr>
											<td class=\"menu\"> ". $row["menu_name"] . "</td>
											<td>" .  $row["menu_price"] . "</td>
											<td>" . $row['countMenu'] . "</td>
											<td>" . $row["menu_price"]*$row['countMenu'] . "</td>
										</tr>
								";}}

							?>					
												</table>
											<hr>
											<div class="row">
												<div class="col-6 col-md-6">
													<p>ราคารวม(บาท)</p>
												</div>
							<?php
							
							$sqlr = "SELECT SUM(menuTotal) as Total FROM BasketOrder WHERE tableId = $tableID";
							$resulty =  mysqli_query($conn->getDatabase(), $sqlr);
							if ($resulty->num_rows > 0) {
								while($row = $resulty->fetch_assoc()) {
									if(!($row['Total'] == '')){
										echo "<div class=\"col-6 col-md-6\" style=\"text-align: right;\">";
										echo "<p>" . $row['Total'] . ".00 ฿</p>";
										echo "</div>";
										echo '</div>
												<button type="button" class="btn btn-success btn-block" onclick="submitorder()">ยืนยันการสั่งอาหาร</button>
												<div style="height: 20px;"></div>
											 </div>';
									}
									else{
										echo "<div class=\"col-6 col-md-6\" style=\"text-align: right;\">";
										echo "<p>0.00 ฿</p>";
										echo "</div>";
										echo '</div>
												<button type="button" class="btn btn-success btn-block" onclick="submitnone()">ยืนยันการสั่งอาหาร</button>
												<div style="height: 20px;"></div>
											 </div>';
									}
								}
							}

							?>
								
						</div>
					
				
				</div>
			</div>
			<div style="height: 320px;"></div>
	<footer>
    <div style="height: 30px;"></div>

      <div>
        <p>หน้าหลัก | รายการอาหาร | จองโต๊ะ | รีวิวจากลูกค้า</p>
      </div>
      <img src="../../image_logo/logotab.png" alt="">
      <div style="height: 30px;"></div>
      <div class="copyright">
        &copy; OHYUMMY 2024
      </div>
      <div style="height: 30px;"></div>

	</footer>

    <!-- --------------------------------------------------------------------------------- -->


<!-- partial -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./basket.js"></script>
	

</body>

</html>
 