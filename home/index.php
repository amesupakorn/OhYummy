<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/favicon.ico" />
    <link href="styles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link rel="stylesheet" href="./style.css">
    <title>หน้าหลัก</title>
</head>
<body style="background-color: #1a1a1a; color: azure; font-family: Noto Sans Thai, sans-serif;">	
	

<?php
     session_set_cookie_params(0);
	 session_start();
	 include('../connectDatabase/connectToDatabase.php');

	 $conn = new database();  

	 if(isset($_GET['tableId'])) {
		// กำหนดค่าใน $_COOKIE โดยตรง
		setcookie('tableId', $_GET['tableId'], 0, '/'); // 0 คือ session cookie จะหมดอายุเมื่อเบราว์เซอร์ปิด
	}


?>
	<div class="navigation-wrap start-header start-style">
		<div class="container" >
			<div class="row">
				<div class="col-12">
				<nav class="navbar navbar-expand-md navbar-light">
					
					<a class="navbar-brand" ><img src="../image_logo/logotab2.png" alt=""></a>	
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto py-4 py-md-0" style="text-align: center;" >
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
								<a class="nav-link" href="../home/index.php">หน้าหลัก</a>
							</li>
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
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
							</li>';
							}
							?>
							
							
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../review/index.php">รีวิวและรายงานปัญหา</a>
							</li>
							
						
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


    <!-- --------------------------------------------------------------------------------- -->

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
		<ol class="carousel-indicators" style="height: 0%;">
		  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100" src="image_home/1.webp" alt="First slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="image_home/3.webp" alt="Second slide">
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="image_home/2.webp" alt="Third slide">
		  </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>
    
      <div class="head">
        <img src="../image_logo/logotab.png" alt="">
        <h1>KOREAN RESTAURANT</h1>
        <a href="../menuorder/menu.php"><button class="custom-btn btn-11">รายการอาหาร</button></a>
		<a href="../reserve/index.php"><button class="custom-btn btn-11">จองโต๊ะ</button></a>

      </div>


	  <section id="OurStory">
		<div class="container">
				<div class="row">
				  <div class="col-md-6">
					<h5 class="comp-title">ABOUT US</h5>
					<h2>KOREAN | RESTAURANT</h2>
					<p>ร้านอาหารเกาหลีบรรยากาศสบาย ๆ เป็นร้านอาหารเกาหลีแท้ ๆ ด้วยการใช้ของตกแต่งสิ่งของภายในร้านที่บ่งบอกถึงความเป็นเกาหลีทั้งหมด มีโต๊ะบริการประมาณ 8 โต๊ะ ส่วนเมนูอาหารมีให้เลือกหลากหลาย เช่น บิบิมเนงเมียน จาจังมยอน มุลแนงเมียน รามยอน นอกจากรสชาติอาหารที่เข้มข้นแล้ว ร้านนี้ยังเหมาะเป็นจุดนัดพบกลุ่มเพื่อน เพราะด้วยบรรยากาศร้านและบริการที่เป็นกันเอง</p>
					<div class="quote"><strong style="color: azure;">ราคา : </strong> ดูได้จากรายการอาหาร</div>
					<div class="quote"><strong style="color: azure;">เวลาเปิด - ปิด : </strong> เปิดบริการทุกวัน เวลา 10.00-22.00 น.</div>
				  </div>
				  <div class="col-md-6">
					<div class="video-img">
					</div>
				  </div>
				</div>
			  </div>
		</div>
	  </section>



	    <!-- Recommend Menu -->
		<div class="recipes">
			<div class="image"></div>
		</div>
	  <!-- Recommend Menu -->
    
	  <section id="SpecialMenu">
		<div class="container">
		  <h5 class="comp-title"> SIGNATURE DISH</h5>
		  <h3>เมนูอาหารแนะนำสำหรับร้านเรา</h3>

		  <div style="height: 30px;"></div>

		  <div class="row">
			<div class="col-md-4">
			  <div class="box">
				<div class="box-img-one">
				<div class="price-circle">139 ฿</div>
				</div>
				<span class="title">บูแดจิเก (부대찌개)</span>
				<p class="details">ข้างล่างรองผักกาดขาวก่อน แล้วก็เอาพวกเห็ดเข็มทอง แครอท ไส้กรอก ปูอัด สันคอหมู เต้าหู้อ่อน มาเรียงกันรอบๆ แล้วจึงเอามาม่าวางตรงกลาง ใส่น้ำครึ่งหม้อ</p>
			  </div>
			</div>
			<div class="col-md-4">
			  <div class="box">
				<div class="box-img-two">
				<div class="price-circle">129 ฿</div>
				</div>
				<span class="title">ต๊อกบกกี (떡볶이)</span>
				<p class="details">นำคาแรต็อก ไปผัดกับซอสเกาหลีสีแดง มีรสชาติเผ็ด หวาน อร่อย มีเอกลักษณ์พร้อมใส่ปลาแผ่น และผักเล็กน้อย ซึ่งในบางร้านจะใส่ไข่ต้มหรือเส้นรามยอนลงไปอีกด้วย</p>
			  </div>
			</div>
			<div class="col-md-4">
			  <div class="box">
				<div class="box-img-three">
				<div class="price-circle">109 ฿</div>
				</div>
				<span class="title">จาจังมยอน (짜장면)</span>
				<p class="details">บะหมี่ดำเกาหลี ใช้เส้นบะหมี่แบบหนาคล้ายเส้นอุด้ง คลุกเคล้าด้วยซอสที่ทำจากเต้าเจี้ยว ถั่วดำหมัก ผัดกับเนื้อหมูหั่นและผัก จาจังมยอนเป็นอาหารที่บอกถึงความโสด</p>
			  </div>
			</div>
		  </div>

		  <div style="height: 30px;"></div>

		  <div class="btncenter">
			<a href="../menuorder/menu.php"><button class="custom-btn2 btn-2">ดูรายการอาหาร</button></a>
		  </div>

		</div>
	  </section>


	  <div class="fixed-image">
		<div class="text">
			<h1>Location</h1>
		</div>

	</div>

	<div style="height: 30px;"></div>

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248057.87072785952!2d100.63532668762527!3d13.724247679480877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d6032280d61f3%3A0x10100b25de24820!2z4LiB4Lij4Li44LiH4LmA4LiX4Lie4Lih4Lir4Liy4LiZ4LiE4Lij!5e0!3m2!1sth!2sth!4v1708336044760!5m2!1sth!2sth" width="1480" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

	
	<footer>
	<div style="height: 30px;"></div>

		<div>
			<p>หน้าหลัก | รายการอาหาร | จองโต๊ะ | รีวิวจากลูกค้า</p>
		</div>
			<img src="../image_logo/logotab.png" alt="">
			<div style="height: 30px;"></div>
		<div class="copyright">
			&copy; OHYUMMY 2024
		</div>
		<div style="height: 30px;"></div>

	</footer>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script><script  src="./script.js"></script>

</body>
</html>