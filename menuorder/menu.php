<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="image_logo/logo.png" />
    <link href="menus.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./menus.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- <link rel="stylesheet"><script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<title>Basket</title>
	

</head>
<body style="background-color: #1a1a1a; font-family: Noto Sans Thai, sans-serif;">	
	<div class="navigation-wrap start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					
						<a class="navbar-brand" ><img src="image_logo/logotab2.png" alt=""></a>	
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
									<a class="nav-link" href="#">หน้าหลัก</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="#">รายการอาหาร</a>
								</li>
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="#">จองโต๊ะ</a>
								</li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="#">รีวิวจากลูกค้า</a>
								</li>
							</ul>
						</div>
						
					</nav>		
				</div>
			</div>
		</div>
	</div>

	<?php
		session_start();
		include('../ject_webpro/connect.php');
		$conn = new database();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ foodid และ count หรือไม่
			if (isset($_POST['foodid']) && isset($_POST['count'])) {
				$foodid = $_POST['foodid'];
				$count = $_POST['count'];

				$check = "SELECT * from BasketOrder WHERE menuId = $foodid Group by menuId";
				$result = mysqli_query($conn->getDatabase(), $check);
		

				if (mysqli_num_rows($result) == 1 ){
					$sqll = "UPDATE BasketOrder SET  countMenu = (countMenu + $count) WHERE menuId = $foodid" ;
					$sqlt = "UPDATE BasketOrder JOIN Menu SET  menuTotal = (countMenu  * menu_price) WHERE BasketOrder.menuId = $foodid AND Menu.menuID = $foodid";
					mysqli_query($conn->getDatabase(), $sqll);
					mysqli_query($conn->getDatabase(), $sqlt);

				} else {
					$keep = "SELECT menu_price FROM Menu WHERE menuID = $foodid ";
					$resulttt =  mysqli_query($conn->getDatabase(), $keep);
					
					if ($resulttt->num_rows > 0) {
						while($row = $resulttt->fetch_assoc()) {
							$menuprice = $row['menu_price'];
							$sqli = "INSERT INTO BasketOrder(menuId, countMenu, menuTotal) VALUES ($foodid, $count, ( $menuprice * $count ) )";
							mysqli_query($conn->getDatabase(), $sqli);
						}

					
					}
				}

				
				
			}
		
		}
		

	?>

	<div style="height: 100px;"></div>

	<div class="containerr">
		<div style="display: flex;">
		<h1 style="color: #fff; margin-top: 3%; margin-left: 15%;"> เมนูรายการอาหาร </h1>
		<button class="custom-btn3 btn-2" style="width: 100px; margin-top: 3%; margin-left: 35%" id="basket" onclick="location.href = 'basket.php';"> 
							<img src="./image_logo/shopping-cart.png">
							ตระกร้า 
		</button> 
		
						
			
		</div>
		<hr>
		<div class="boxfood">
			<div style="display: flex;">
				<div class="btncenter" style="background-color: #1a1a1a; margin-left: 15%;">
					<div>
						<button class="custom-btn3 btn-2" onclick="filter('card')">ทั้งหมด</button>
						<button class="custom-btn3 btn-2" onclick="filter('main')" >จานหลัก</button>
						<button class="custom-btn3 btn-2" onclick="filter('soup')">ซุป</button>
						<button class="custom-btn3 btn-2" onclick="filter('snack')">ทานเล่น</button>
						<button class="custom-btn3 btn-2" onclick="filter('dessert')">ของหวาน</button>
						<button class="custom-btn3 btn-2" onclick="filter('drink')">เครื่องดื่ม</button>
						
					</div>

				</div>
				
			</div>
			<div class="mainboxx">

			<?php
	
			include('../ject_webpro/orderController.php');

			$order = new OrderController();
	

			$sql = "SELECT * from Menu";
			$result =  mysqli_query($conn->getDatabase(), $sql);
		


			if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				$typefood = $row["menu_type"];
				$foodid = $row["menuID"];
			echo "<div class=\"card $typefood \" style=\"width: 18rem; border-radius:15px; overflow: hidden;\">". 
					"<img class=\"card-img-top\" src=\"image_menu/".$row["image_menu"] . "\"> " .
					"<div class=\"card-body\">".
						"<h5 class=\"card-title\" style=\"margin-left:2%;\"> <strong>" . $row["menu_name"]. " </strong> </h5>". 
						"<p class=\"card-text\" style=\"font-size:25px; color: red; margin-bottom: 0 ;text-align: right;
						margin-right: 12%; \">".$row["menu_price"]. " ฿ <br>" . "</p> ". 
						"<div style=\"display: flex\">
							<div class=\"qty mt-5\" style=\"margin-top: 1rem!important; margin-left: 3%\">
								<span class=\"minus bg-dark \" onclick=\"minus('$foodid')\">-</span>
									
										<input type=\"number\" class=\"count\" id=\"$foodid\" name=\"qty\" value=\"1\">
	
								<span class=\"plus bg-dark \" onclick=\"plus('$foodid')\">+</span>
                    		</div>
							<div class=\"btncenter\">
								<button class=\"custom-btn2 btn-2\" type=\"submit\" id=\"confirmButton\" onclick=\"updateBasket('$foodid') \">เพิ่มในตระกร้า</button>
										</div>
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


	

<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script  src="./script.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>