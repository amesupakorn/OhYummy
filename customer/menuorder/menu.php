<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../../image_logo/favicon.ico"/>
    <link href="menus.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./menus.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- <link rel="stylesheet"><script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
	<title>เมนู</title>
	<link rel='stylesheet' href='https://unpkg.com/font-awesome@4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

	
<!------ Include the above in your HEAD tag ---------->


</head>
<body style="background-color: #1a1a1a; font-family: Noto Sans Thai, sans-serif;">	
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
										<a class="nav-link" href="../reserve/reserve.php">จองโต๊ะ</a>
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

	<?php
		session_start();
		include('../../connectDatabase/connectToDatabase.php');
		$conn = new database();
		if(isset($_COOKIE['tableId'])){
			$tableID = $_COOKIE['tableId'];
		}
		

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ foodid และ count หรือไม่
			if (isset($_POST['foodid']) && isset($_POST['count'])) {
				$foodid = $_POST['foodid'];
				$count = $_POST['count'];

				$check = "SELECT * from BasketOrder WHERE menuId = $foodid AND tableId = $tableID Group by menuId";
				$result = mysqli_query($conn->getDatabase(), $check);
		

				if (mysqli_num_rows($result) == 1 ){
					$sqll = "UPDATE BasketOrder SET  countMenu = (countMenu + $count) WHERE menuId = $foodid AND tableId = $tableID " ;
					$sqlt = "UPDATE BasketOrder JOIN Menu SET  menuTotal = (countMenu  * menu_price) WHERE BasketOrder.menuId = $foodid AND Menu.menuID = $foodid AND tableId = $tableID ";
					mysqli_query($conn->getDatabase(), $sqll);
					mysqli_query($conn->getDatabase(), $sqlt);

				} else {
					$keep = "SELECT menu_price FROM Menu WHERE menuID = $foodid";
					$resulttt =  mysqli_query($conn->getDatabase(), $keep);
					
					if ($resulttt->num_rows > 0) {
						while($row = $resulttt->fetch_assoc()) {
							$menuprice = $row['menu_price'];
							$sqli = "INSERT INTO BasketOrder(menuId, countMenu, menuTotal, tableId) VALUES ($foodid, $count, ( $menuprice * $count ), $tableID)";
							mysqli_query($conn->getDatabase(), $sqli);
						}

					
					}
				}

				
				
			}
		
		}
		

	?>

<div style="height: 10px;"></div>
	<div class="bet"></div>


	<div class="container-fluid">
		<div class="row">
			<div class="col-10" style="text-align: left;">
				<h2 class="typehead1" style="color: #fff; margin-top: 5%; margin-left: 5%;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 20">
  <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
</svg>&nbsp;เมนูแนะนำ</h2>
			</div>
			<div class="col-2">
				<div class="btnbas">

			</div>
		</div>
	</div>
	<div style="height: 20px;"></div>
		

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="caroheight carousel-inner row mx-0">
	  <?php
	
			$sql = "SELECT * FROM Menu WHERE menuID = 23";
			$result =  mysqli_query($conn->getDatabase(), $sql);


			if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
		
			$typefood = $row["menu_type"];
			$foodid = $row["menuID"];
			echo '<div class="carousel-item col-12 col-md-4 active">
				<img class="card-img-top" src="../../image_menu/'.$row['image_menu'].'">
			</div>';
			}
		}
		$sql2 = "SELECT * FROM Menu LIMIT 7";
		$result2 =  mysqli_query($conn->getDatabase(), $sql2);



		if ($result2->num_rows > 0) {
		while($row2 = $result2->fetch_assoc()) {
	
		$typefood2 = $row2["menu_type"];
		$foodid2 = $row2["menuID"];
		echo '<div class="carousel-item col-12 col-md-4">
				<img class="card-img-top" src="../../image_menu/'.$row2['image_menu'].'">
			</div>';
		}
		}

		?>
        

        </div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="hideee col-md-4">
				<h2 class="typehead" style="color: #fff; margin-top: 5%; margin-left: 20%;">หมวดหมู่</h2>
			</div>
			<div class="col-12 col-md-8">
				<div class="boxfood">
					<div style="display: flex; justify-content: center;">
						<div class="btnhead">
							<div>
								<button class="custom-btn3 btn-2" onclick="filter('card')"><span style="vertical-align: middle; font-size: 16px;" class="material-symbols-outlined">apps</span>&nbsp;ทั้งหมด</button>
								<button class="custom-btn3 btn-2" onclick="filter('main')" ><span class="material-symbols-outlined" style="vertical-align: middle; font-size: 16px;">thumb_up</span>&nbsp;จานหลัก</button>
								<button class="custom-btn3 btn-2" onclick="filter('soup')"><span class="material-symbols-outlined" style="vertical-align: middle; font-size: 16px;">soup_kitchen</span>&nbsp;ซุป</button>
								<button class="custom-btn3 btn-2" onclick="filter('snack')"><span class="material-symbols-outlined" style="vertical-align: middle; font-size: 16px;">tapas</span>&nbsp;ทานเล่น</button>
								<button class="custom-btn3 btn-2" onclick="filter('dessert')"><span class="material-symbols-outlined" style="vertical-align: middle; font-size: 16px;">icecream</span>&nbsp;ของหวาน</button>
								<button class="custom-btn3 btn-2" onclick="filter('drink')"><span class="material-symbols-outlined" style="vertical-align: middle; font-size: 16px;">local_cafe</span>&nbsp;เครื่องดื่ม</button>
							
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr style="border-top: 1px solid azure; width: 90%;">


			<div class="mainboxx">

			<?php
	

			$sql = "SELECT * from Menu WHERE menu_status = 'on'";
			$result =  mysqli_query($conn->getDatabase(), $sql);
		


			if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				$typefood = $row["menu_type"];
				$foodid = $row["menuID"];
			echo "<div class=\"card $typefood\">". 
					"<img class=\"card-img-top\" src=\"../../image_menu/".$row["image_menu"] . "\"> " .
					"<div class=\"card-body\">".
					"<div class=\"title-price-container\">".
						"<h5 class=\"card-title\"> <strong>" . $row["menu_name"]. " </strong> </h5>". 
						"<p class=\"card-text\">".$row["menu_price"]. " ฿ </p>". 
					"</div>".
						"<div style=\"display: flex\">
							<div class=\"many qty\">
							   <div class='menu'>
								<span class=\"minus bg-dark \" onclick=\"minus('$foodid')\">-</span>
									
										<input type=\"number\" class=\"count\" id=\"$foodid\" name=\"qty\" value=\"1\">
	
								<span class=\"plus bg-dark \" onclick=\"plus('$foodid')\">+</span>
								</div>
                    		</div>
							<div class=\"btncenter\">";
							
							if(!isset($_COOKIE['tableId'])){
								echo "<button class=\"custom-btn2 btn-2\" type=\"submit\" id=\"confirmButton\" onclick=\"alertlogin()\">เพิ่มในตระกร้า</button>";
							}
							else{
								echo "<button class=\"custom-btn2 btn-2\" type=\"submit\" id=\"confirmButton\" onclick=\"updateBasket('$foodid') \">เพิ่มในตระกร้า</button>";
							}
				
				echo					"</div>
									</div>".
								"</div>".
							"</div>";

			
						}
			} else {
				echo "0 results";
			}
			?>

			</div>
		</div>
   </div>

	<?php
   								if(isset($tableID)){
									$sqlr = "SELECT SUM(countMenu) as totalCount FROM BasketOrder WHERE tableId = $tableID";
									$resultTotal =  mysqli_fetch_assoc(mysqli_query($conn->getDatabase(), $sqlr));
									$total = $resultTotal['totalCount'];
									if(!$total == ''){
										echo '
										<div class="floating-chat"  aria-hidden="true">
										<button id="cart" class="cart" data-totalitems="'.$total.'"
											onclick="location.href = \'../basket/basket.php\';"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
											<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
										  </svg>
										</button>
										</div>';
									}
									else{
										echo '
										<div class="floating-chat"  aria-hidden="true">
											<button id="cart" class="cart" data-totalitems="0"
										onclick="location.href = \'../basket/basket.php\';"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
										<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
									  </svg>
									</button>
									</div>';
									}
								}else{
									echo '';

								}

	?>
   



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

	

<!-- partial -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src='https://unpkg.com/jquery@3.3.1/dist/jquery.js'></script>
<script src='https://unpkg.com/popper.js@1.12.9/dist/umd/popper.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script  src="./script.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script><script  src="./script.js"></script>


</body>
</html>