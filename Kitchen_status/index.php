<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link rel="stylesheet">
	<script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="button.css">
	<!-- <link href="styles.css" rel="stylesheet" /> -->
	<title>Document</title>
</head>
<?php
session_start();
include('../connectDatabase/connectToDatabase.php');

$conn = new database();


?>

<body style="font-family: Noto Sans Thai, sans-serif;">

	<nav class="nav">
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">dashboard</i>
			<span class="nav__text">Dashboard</span>
		</a>
		<a href="#" class="nav__link nav__link--active">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>



	<?php
	$sqlOrder = "SELECT * FROM OrderTable;";
	$result = mysqli_query($conn->getDatabase(), $sqlOrder);

	$num = mysqli_num_rows($result);
	echo
	'<div class="">
				<div style="height: auto; background-color: white;">
					<div class="container">
						<div style="height: 30px;"></div>
						<h3>
						มีรายการอาหารทั้งหมด ' . $num . ' รายการ</h3>
					<div style="height: 10px;"></div>
				</div>
			</div>';
	?>



	<div class="container">
		<div class="row">

			<?php
			$sqlOrder = "SELECT * FROM OrderTable;";
			$result = mysqli_query($conn->getDatabase(), $sqlOrder);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					if ($row['orderStatus'] == "take" || $row['orderStatus'] == "doing") {
						echo
						'<div class="col-sm-4 py-2">
							<div class="card">
								<div class="card-bg">
									<h3 class="card-title text-center" style="line-height: 80px">โต็ะ หมายเลข ' . $row['tableid'] . '</h3>
								</div>
									<div class="card-body">
											<h5 class="card-subtitle mb-3">รายการอาหารที่สั่ง</h5>
									<div class="row">
										<div class="col-8">รายการอาหาร</div>
										<div class="col-4">จำนวน</div>
									</div><br>
									<div class="menu">';
								$orderid = $row['orderID'];
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
																<div class="col-9">' . $row['menu_name'] . '</div>
																<div class="col-3">' . $order_item['menuCount'] . '</div>
															</div><br>';
													}
												}
											}
										}
									}
								}
						echo '
									</div>
									<h6 class="card-subtitle mb-2 text-muted">
										<div class="bottom-text">
											<button class="button-24" role="button">กำลังทำ</button>
											<button class="button-24G" role="button">เสร็จสิ้น</button>
									</div>
								</div>
							</div>
						</div>';
					}
				}
			}

	?>
			</div>
		</div>
		<script src="scripts.js"></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
		<script src="./script.js"></script>
</body>

</html>