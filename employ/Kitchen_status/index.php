<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/logo.png" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">

	<link rel="stylesheet">
	<script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href=".css">
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="button.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <link href="styles.css" rel="stylesheet" /> -->
	<title>จัดการออเดอร์</title>
</head>
<?php
session_start();
include('../../connectDatabase/connectToDatabase.php');

$conn = new database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ order_id และ order_status หรือไม่
	if (isset($_POST['order_id']) && isset($_POST['order_status'])) {
		// รับค่า order_id และ order_status จากการส่งคำขอ HTTP POST
		$orderID = $_POST['order_id'];
		$orderStatus = $_POST['order_status'];
		$tableID = $_POST['table_id'];
		$orderTotal = $_POST['order_Total'];

		if ($orderStatus == 'take') {
			$query = "UPDATE OrderTable SET orderStatus = '$orderStatus'  WHERE orderID = $orderID";
			mysqli_query($conn->getDatabase(), $query);
		} else {
			$query = "UPDATE OrderTable SET orderStatus = '$orderStatus'  WHERE orderID = $orderID";
			mysqli_query($conn->getDatabase(), $query);
		}
	}
}

?>

<body style="font-family: Noto Sans Thai, sans-serif; background-color: #f6f9fc;">

<nav class="nav">
        <a href="../editMenu/index.php" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		
		<a href="../status_menu/index.php" class="nav__link">
			<i class="material-icons nav__icon">reorder</i>
			<span class="nav__text">ดูสถานะออเดอร์</span>
		</a>
		
		<a href="../kitchen_status/index.php" class="nav__link  nav__link--active">
			<i class="material-icons nav__icon">soup_kitchen</i>
			<span class="nav__text">จัดการออเดอร์ (ครัว)</span>
		</a>
		<a href="../index.php" class="nav__link">
			<i class="material-icons nav__icon">dashboard</i>
			<span class="nav__text">หน้าหลัก</span>
		</a>

        <a href="../editTable/index.php" class="nav__link">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
		<a href="../status_reserve/index.php" class="nav__link">
			<i class="material-icons nav__icon">install_mobile</i>
			<span class="nav__text">จัดการจองโต๊ะ</span>
		</a>
	
		<a href="../bill/index.php"  class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="../billHistory/index.php" class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>
	</nav>



	<?php
	$sqlOrder = "SELECT * FROM OrderTable WHERE orderStatus = 'take' OR orderStatus = 'doing';";
	$result = mysqli_query($conn->getDatabase(), $sqlOrder);

	if ($result) {
		$num = mysqli_num_rows($result);
	} else {
		echo "การดึงข้อมูลผิดพลาด: " . mysqli_error($conn->getDatabase());
	}

	echo
	'
    <div style="height: 20px;"></div>
		<div class="container-fluid mx-3">
			<div class="texthead">
						<div style="height: 20px;"></div>
						<h3>
						&nbsp;&nbsp;&nbsp;มีรายการอาหารทั้งหมด ' . $num . ' รายการ | <span id=\'clock\'></span></h3> 
					<div style="height: 10px;"></div>
				</div>
			</div>';
	?>
	    <div style="height: 10px;"></div>


	<div class="container mx-5">
		<div class="row">

			<?php
			$sqlOrder = "SELECT * FROM OrderTable;";
			$result = mysqli_query($conn->getDatabase(), $sqlOrder);
			if ($num > 0) {


				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {

						if ($row['orderStatus'] == "take" || $row['orderStatus'] == "doing") {
						echo
						'<div class= "col-4 py-20">
							<div class="card" style="width: 370px;">
								<div class="card-bg">
									<h3 class="card-title text-center" style="line-height: 80px; color: white;">โต็ะ หมายเลข ' . $row['tableid'] . '</h3>
								</div>
									<div class="card-body">
											<div class="row">
												<div class="col-6 my-2"" >รายการอาหารที่สั่ง</div>';
							if ($row['orderStatus'] == "take") {
								echo '<div class="col-6"><button type="button" style="padding: 5px 25px;" class="btn btn-danger" disabled>รอดำเนิดการ</button></div>';
							} else {
								echo '<div class="col-6"><button type="button" style="padding: 5px 40px; color: white;" class="btn btn-warning" disabled>กำลังทำ</button></div>';
							}
							echo '</div><br>
									<div class="row">
										<div class="col-8">รายการอาหาร</div>
										<div class="col-4">จำนวน</div>
									</div><br>
									<div class="menu">';
							$orderid = $row['orderID'];
							$tableid = $row['tableid'];
							$orderTotal = $row['orderTotal'];
							$orderStatus = $row['orderStatus'];

							$select_sql = "SELECT orderMenu FROM OrderTable WHERE orderid = '$orderid'";
							$resultorder = mysqli_query($conn->getDatabase(), $select_sql);

							if ($resultorder->num_rows > 0) {
								while ($row = $resultorder->fetch_assoc()) {
									$order_menu_json = $row['orderMenu'];

									// แปลง JSON เป็น associative array
									$order_menu_data = json_decode($order_menu_json, true);

									if (isset($order_menu_data['order'])) {
										$order_items = $order_menu_data['order'];

										foreach ($order_items as $order_item) {
											$menu_id =  $order_item['menuId'];
											$name = "SELECT * FROM Menu WHERE menuID = $menu_id;";
											$resultmenu = mysqli_query($conn->getDatabase(), $name);
											if (mysqli_num_rows($resultmenu) > 0) {
												while ($row = mysqli_fetch_assoc($resultmenu)) {
													echo '<div class="row">
																<div class="col-9" >' . $row['menu_name'] . '</div>
																<div class="col-3">' . $order_item['menuCount'] . '</div>
															</div><br>';
												}
											}
										}
									}
								}
							}
							echo '</div>
									<h6 class="card-subtitle mb-2 text-muted">
										<div class="bottom-text">';
										if ($orderStatus == "take"){
											echo '<button class="btn btn-warning" style="padding: 8px 100px;" onclick="updateOrderStatus(' . $orderid . ',\'doing\',' . $tableid . ',' . $orderTotal. ')" role="button">กำลังทำ</button>';
										}else {
											echo'<button class="btn btn-primary" style="padding: 8px 100px;" onclick="updateOrderStatus (' . $orderid . ',\'finish\',' . $tableid . ',' . $orderTotal. ');" role="button">เสร็จสิ้น</button>';
										}
							echo '</div>
								</div>
							</div>
						</div>';
						}
					}
				}
			} else {
				echo '<h1 style="color: #9C9C9C; margin-top: 25%; margin-left: 45%;">ไม่มีออเดอร์ในขณะนี้....</h1>';
			}

			?>
		</div>
	</div>

	<div style="height: 50px;"></div>
	<script src="scripts.js"></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>
</body>

</html>