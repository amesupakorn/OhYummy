<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="png" sizes="96x96" href="logo.png" />
    <link href="style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <title>จองโต๊ะ</title>

  </head>
  <body
    style="
      background-color: #1a1a1a;
      color: azure;
      font-family: Noto Sans Thai, sans-serif;
    "
  >

  <div class="fixed-image">
		<div class="text">
			<h1>จองโต๊ะ</h1>
		</div>
	</div>

  <div class=container-fluid>
    

  </div>





























    <div class="navigation-wrap start-header start-style">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-md navbar-light">
              <a class="navbar-brand"><img src="logotab2.png" alt="" /></a>

              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
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

    <div class="content" style="height: 110px"></div>

    <?php
          session_start();
          include('../connectDatabase/connectToDatabase.php');

          $conn = new database();
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['name']) && isset($_POST['tel']) && isset($_POST['seat']) && isset($_POST['email']) && isset($_POST['date'])){
              
              $name = $_POST['name'];
              $tel = $_POST['tel'];
              $email = $_POST['email'];
              $seat = $_POST['seat'];
              $date = $_POST['date'];
              echo 'dd';
              $sql = "INSERT INTO Reserve(cust_Name, cust_Tel, email, Reserve_time) VALUES ('$name', '$tel', '$email', $date)";
              mysqli_query($conn->getDatabase(), $sql);
            }
          
          }
    ?>
    
    <div class="container">
      <h3>จองโต๊ะอาหาร</h3><hr/>

      <div class="row">

        <div class="form-group col-4">
          <label for="name">ชื่อ (Name)</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อจริง">
        </div>

        <div class="form-group col-4">
          <label for="email">อีเมลล์ (Email)</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="อีเมลล์">
        </div>

        <div class="form-group col-4">
          <label for="tel">เบอร์โทรศัพท์ (Telephone)</label>
          <input type="number" class="form-control" id="tel" name="tel" placeholder="เบอร์โทรศัพท์">
        </div>

      </div>


      <div class="row">

          <div class="form-group col-4">
            <label for="seat">จำนวนที่นั่ง</label>
            <select class="form-control" id="seat">
              <option value="00">กรุณาเลือกจำนวนที่นั่ง</option>
              <option value="2">โต๊ะ 2 ที่นั่ง</option>
              <option value="4">โต๊ะ 4 ที่่นั่ง</option>
              <option value="6">โต๊ะ 6 ที่นั่ง</option>
            </select>
          </div>


      </div><br>
      
      <div style="text-align: center;">
    </div>
    </div>
    
    <?php
      //  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      //   if(isset($_POST['datecheck'])){
      //     $formattedDate = date('Y-m-d', strtotime($_POST['datecheck']));
      //     $sqltime = "SELECT Reserve_time FROM Reserve WHERE DATE(Reserve_time) = '$formattedDate'";
      //     // $result = $conn->query($sqltime);
      //   }
      //  }
      ?>

    
    <div style="text-align: center;"><button type="button" class="btn btn-danger" onclick="bookTime()">จอง</button></div>
    
    <!-- --------------------------------------------------------------------------------- -->

    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="./script.js"></script>
    <script>
      function bookTime(){
	  let name = document.getElementById("name").value;
    let tel = document.getElementById("tel").value;
	  let email = document.getElementById("email").value;
	  let seat = document.getElementById("seat").value;
	  let date = document.getElementById("date").value;

    let formData = new URLSearchParams();
        
        formData.append('name', name);
		    formData.append('email', email);
        formData.append('tel', tel);
        formData.append('seat', seat);
        formData.append('date', date);

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
                    icon: "success",
                    title: "ข้อมูลการจองของคุณบันทึกเรียบร้อย",
                    showConfirmButton: false,
                    timer: 3500
                  });
         
                return response.text();
            }
            throw new Error('Network response was not ok.');
        })
        .catch(error => {
            alert('There was a problem with the fetch operation: ' + error.message);
        });
}

      </script>
    
  </body>
</html>
