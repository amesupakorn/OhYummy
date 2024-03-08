<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="png" sizes="96x96" href="../../image_logo/logo.png" />
    <link href="style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet"/>   
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./style.css" />
    <title>รีวิวและรายงาน</title>
  </head>
  <body
    style="
      background-color: #1a1a1a;
      color: azure;
      font-family: Noto Sans Thai, sans-serif;
    "
  >
  <?php
          session_start();
          include('../../connectDatabase/connectToDatabase.php');

          $conn = new database();  

          if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['review']) && isset($_POST['name']) && isset($_POST['Tel'])){
    
              $review = $_POST['review'];
              $name = $_POST['name'];
              $tel = $_POST['Tel'];
              $sql = "INSERT INTO Review(descript, username, tel, ReviewTime) VALUES ('$review', '$name', '$tel', DATE_ADD(NOW(), INTERVAL 7 HOUR))";
              mysqli_query($conn->getDatabase(), $sql);
            }
          }

    ?>
  <div class="navigation-wrap start-header start-style">
		<div class="container" >
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
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
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
              			
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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

    <div class="content" style="height: 110px"></div>


    <div class="container">
      
      <br />
      <div class="headtext" style="text-align: center">
          <h3>เรายินดีรับความคิดเห็นจากคุณ</h3><br>
          <h6>บอกเล่าถึงประสบการณ์ที่คุณได้รับเมื่อมาใช้บริการที่โอ้อร่อยของเรา กรุณาบอกกับเราว่าสิ่งใดที่คุณชื่นชอบ <br>
    หรือสิ่งใดที่ควรปรับปรุง เราเรียนรู้จากคุณ เพื่อมอบความพึงพอใจสูงสุดจากการใช้บริการของเรา</h6><br>
      </div>
      <hr><br><br>
      <div class="form-group">
        <label for="review">ความคิดเห็น :) <strong style="color: #DC0000;">*</strong></label><br />
        <textarea type="text" id="review" name="review" class="col-12" rows="8" placeholder="แสดงความคิดเห็นของท่าน"></textarea>
      </div>
      <div class="form-row">
        <div class="col-12 col-md-6">
          <div class="form-floating mb-3">
            <label for="name">ชื่อ (Name) <strong style="color: #DC0000;">*</strong></label><br />
            <input  type="text" id="name" name="name" class="col-12"  placeholder="ชื่อ" />
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-floating mb-3">
            <label for="Tel">เบอร์โทรศัพท์สำหรับติดต่อ (Tel.) <strong style="color: #DC0000;">*</strong></label><br />
            <input    type="number" id="Tel" name="Tel" class="col-12"  placeholder="เบอร์โทรศัพท์"
            />
          </div>
        </div>
      </div>
      <div style="height: 10px;"></div>
      <div class="center-container"><br>
        <button style="width: 300px;" id="confirmButton" class="btn btn-danger" onclick="updateReview()" >ยืนยัน</button><br><br>
      </div>
    </div>
    <div style="height: 50px;"></div>

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
    <script>

   function updateReview() {
      let review = document.getElementById("review").value;
      let name = document.getElementById("name").value;
      let tel = document.getElementById("Tel").value;

      if(review.trim() === "" || name.trim() === "" || tel.trim() === ""){
        Swal.fire({
          icon: "error",
          title: "โปรดกรอกข้อมูลให้ครบ"
    });

  } else{
    
    let formData = new URLSearchParams();
        formData.append('review', review);
        formData.append('name', name);
        formData.append('Tel', tel);
        
        Swal.fire({
        title: "ยืนยันการส่งรีวิว",
        text: "การรีวิวนี้จะเป็นส่วนหนึ่งในหารปรับปรุงของเรา",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#137BFF",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก"
      
      }).then((result) => {
      
        if (result.isConfirmed) {
          
          fetch('./index.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: formData.toString()
            })
            .then(response => {
              if (response.ok) {
                Swal.fire({
                  title: "ขอบคุณสำหรับรีวิวของคุณ",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 3000
      
                });
                setTimeout(function() {
                  location.reload();
                }, 1000);
                return response.text();
              }
              throw new Error('Network response was not ok.');
            })
            .catch(error => {
              alert('There was a problem with the fetch operation: ' + error.message);
            });

		}
    })
  }}
    </script>
    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="./script.js"></script>
  </body>
</html>
