<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/logo.png" />
    <link href="styles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"><script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <title>เช็คการจองโต๊ะ</title>
</head>
<body style="background-color: #f6f9fc; font-family: Noto Sans Thai, sans-serif;">
<nav class="nav">
        <a href="../editMenu/index.php" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		
		<a href="../status_menu/index.php" class="nav__link">
			<i class="material-icons nav__icon">reorder</i>
			<span class="nav__text">ดูสถานะออเดอร์</span>
		</a>
		<a href="../kitchen_status/index.php" class="nav__link">
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
        <a href="../status_reserve/index.php" class="nav__link nav__link--active">
			<i class="material-icons nav__icon">install_mobile</i>
			<span class="nav__text">จัดการจองโต๊ะ</span>
		</a>
	
		<a href="../bill/index.php"  class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="../billHistory/index.php"class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>
  <?php
    session_start();
    include('../../connectDatabase/connectToDatabase.php');

    $conn = new database();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['reserve'])){
            
            $id = $_POST['reserve'];
            $status = $_POST['status'];

            if($status == 'cancel'){
                $sql = "DELETE FROM Reserve WHERE reserveID = $id";
                mysqli_query($conn->getDatabase(), $sql);

            }
            else{
                $sqlsel = "SELECT * FROM Reserve WHERE reserveID = $id";
                $result = mysqli_query($conn->getDatabase(), $sqlsel);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $tableid = $row['tableid'];
                    $day = $row['reserve_day'];
                    $time = $row['reserve_time'];
                    $datetime = date("Y-m-d H:i:s", strtotime("$day $time"));
                
                $sql = "UPDATE Reserve SET status_Reserve = 'finish' WHERE reserveID = $id";
                mysqli_query($conn->getDatabase(), $sql);

                $sqlupdate = "UPDATE Tables SET table_status = 'reserve', checkIn = '$datetime' WHERE tableID = $tableid";
                mysqli_query($conn->getDatabase(), $sqlupdate);
            }
        }
    }}

    ?>


<div style="height: 20px;"></div>
		<div class="container-fluid mx-3">
			<div class="texthead">
        <div style="height: 20px;"></div>
        <?php 
                $num = mysqli_num_rows($conn->executeQuery("Reserve"));
                echo  "<h3>&nbsp;&nbsp;&nbsp;การจองทั้งหมด $num  | <span id=clock></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>

    <div style="height: 100px;"></div>
    <div class="container">
            <div class="row">
              <div class="col-12">
                <table id="example" class="table table-hover responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>สถานะ</th>
                      <th>เลขการจอง</th>
                      <th>ชื่อลูกค้า</th>
                      <th>เบอร์โทรลูกค้า</th>
                      <th>อีเมลลูกค้า</th>
                      <th>วันที่จอง</th>
                      <th>เวลาที่จอง</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   
                      <?php
                      $sqlMenu = "SELECT * FROM Reserve;";
                      $result = mysqli_query($conn->getDatabase(), $sqlMenu);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>';
                            if($row['status_Reserve'] == 'finish'){
                                echo '<button type="button" class="btn btn-primary" style="padding: 2px 10px;">เสร็จสิ้น</button>';
                              }
                              elseif($row['status_Reserve'] == 'wait'){
                                echo '<button type="button" class="btn btn-warning" style="padding: 2px 20px;">รอเข้าโต๊ะ</button>';
                              }
                              elseif($row['status_Reserve'] == 'cancel'){
                                echo '<button type="button" class="btn btn-danger" style="padding: 2px 26px;">ยกเลิก</button>';
                              } 
                            echo '</td>';
                            echo '<td style="vertical-align: middle;">'.$row['reserveID'].'</td>';
                                     
                            echo '</td>';
                            echo '<td style="vertical-align: middle;">'.$row['cust_Name'].'</td>
                                  <td style="vertical-align: middle;">'.$row['cust_Tel'].'</td>
                                  <td style="vertical-align: middle;">'.$row['email'].'</td>
                                  <td style="vertical-align: middle;">'.$row['reserve_day'].'</td>
                                  <td style="vertical-align: middle;">'.$row['reserve_time'].'</td>';
                            echo '<td>
                            <button type="button" class="btn btn-primary" onclick="updateStatus('.$row['reserveID'].', \'finish\')" style="padding: 2px 10px;">ลูกค้าเข้า</button>
                            <button type="button" class="btn btn-danger" onclick="updateStatus('.$row['reserveID'].', \'cancel\')" style="padding: 2px 10px;">ยกเลิก</button>
                                </td>';
                        }
                    }
                      
                      
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <!-- partial -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

          <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js'></script>
          <script src='https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js'></script>
          <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script><script  src="./script.js"></script>
          
</body>
</html> 
